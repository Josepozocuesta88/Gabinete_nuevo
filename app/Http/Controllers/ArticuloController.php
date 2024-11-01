<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Articulo;
use App\Models\Category;
use App\Models\Precio;
use App\Services\ArticleService;
use App\Contracts\OfertaServiceInterface;
use App\Services\OfertasGeneralesService;
use App\Services\OfertasPersonalizadasService;

class ArticuloController extends Controller
{
    protected $articleService;
    private $ofertaService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function showByCategory($catcod, OfertasGeneralesService $ofG)
    {
        $ofertasService = app(\App\Contracts\OfertaServiceInterface::class);
        $ofertas        = $ofertasService->obtenerOfertas();
        $categoria      = Category::where('id', $catcod)->firstOrFail();

        if (Auth::user()) {
            $articulos = $categoria->articulos()
                ->where('artsit', 'C')
                ->where('artcatcodw1', $catcod)
                ->paginate(12);
        } else {
            $articulos = $categoria->articulos()->where(function ($query) {
                $query->where('artsolcli', '<>', 1)
                    ->orWhereNull('artsolcli');
            })
                ->where('artsit', 'C')
                ->where('artcatcodw1', $catcod)
                ->paginate(12);
        }

        $articulosOferta = $ofG->obtenerArticulosEnOferta();
        session()->forget('search');
        return $this->prepareView($articulos, $categoria->nombre_es, $ofertas, $articulosOferta);
    }

    public function info($artcod)
    {
        $articulo = Articulo::with('imagenes', 'alergenos', 'cajas')->find($artcod);

        if (!$articulo) {
            return redirect('/articles/search?query=')->with('error', 'Artículo no encontrado');
        }

        $alergenos          = $articulo->alergenos->pluck('tagnom');
        $cajas              = $articulo->cajas;
        $articulos          = collect([$articulo]);
        $usutarcod          = Auth::user() ? Auth::user()->usutarcod : '';
        $articulosConPrecio = $this->articleService->calculatePrices($articulos, $usutarcod);
        $articuloConPrecio  = $articulosConPrecio->first();

        return view('pages.ecommerce.productos.article-details', [
            'articulo' => $articuloConPrecio,
            'precio' => $articuloConPrecio->precio,
            'alergenos' => $alergenos,
            'cajas' => $cajas,
        ]);
    }

    public function search(Request $request, OfertasGeneralesService $ofG)
    {
        session(['search' => $request->get('query')]);
        $keywords = explode(' ', $request->get('query'));

        if (!Auth::user()) {
            $articulos = Articulo::situacion('C')->search($keywords)
                ->restrictions()
                ->with(['imagenes', 'cajas'])
                ->paginate(12);
        } else {
            $articulos = Articulo::situacion('C')->search($keywords)
                ->restrictions()
                ->with(['imagenes', 'cajas'])
                ->paginate(12);
        }

        $ofertasService     = app(\App\Contracts\OfertaServiceInterface::class);
        $ofertas            = $ofertasService->obtenerOfertas();
        $articulosOferta    = $ofG->obtenerArticulosEnOferta();

        return $this->prepareView($articulos, null, $ofertas, $articulosOferta);
    }

    public function filters(Request $request, $catnom = null)
    {
        $ofG        = new OfertasGeneralesService();
        $search     = session('search');
        $keywords   = explode(' ', $search);

        $query = Articulo::situacion('C')->search($keywords)
            ->restrictions()
            ->with(['imagenes', 'cajas']);

        // logica filtros
        $today      = Carbon::now();
        $usutarcod  = Auth::user() ? Auth::user()->usutarcod : '';
        $query->whereNotNull('artnom');
        $categoriaNombre = null;

        if ($catnom) {
            $query->whereHas('categoria', function ($query) use ($catnom) {
                $query->where('nombre_es', $catnom);
            });
            $categoriaNombre = $catnom;
        }

        if ($request->has('orden_oferta')) {
            $usuofecod = Auth::user()->usuofecod;
            $query->leftJoin('qofertac', function ($join) use ($today, $usuofecod) {
                $join->on('qanet_articulo.artcod', '=', 'qofertac.ofcartcod')
                    ->where('qofertac.ofccod', $usuofecod)
                    ->where('qofertac.ofcfecfin', '>=', $today);
            })
                ->orderByRaw('ISNULL(qofertac.ofcartcod)')
                ->select('qanet_articulo.*')
                ->groupBy('qanet_articulo.artcod');
        }

        if ($request->has('orden_precio')) {
            $usutarcod = Auth::user()->usutarcod;

            $query->orderBy(
                Precio::select('preimp')
                    ->whereColumn('preartcod', 'qanet_articulo.artcod')
                    ->where('pretarcod', $usutarcod)
                    ->orderBy('preimp', $request->input('orden_precio'))
                    ->limit(1),
                $request->input('orden_precio')
            );
        }

        if ($request->has('orden_nombre')) {
            $query->orderBy('artnom', $request->input('orden_nombre'));
        }

        $articulos       = $query->paginate(12)->appends($request->all());
        $ofertasService  = app(\App\Contracts\OfertaServiceInterface::class);
        $ofertas         = $ofertasService->obtenerOfertas();
        $articulosOferta = $ofG->obtenerArticulosEnOferta();
        return $this->prepareView($articulos, $catnom, $ofertas, $articulosOferta);
    }

    private function prepareView($articulos, $catnom = null, $ofertas = null, $articulosOferta = null)
    {
        $favoritos  = Auth::user() ? Auth::user()->favoritos->pluck('favartcod')->toArray() : [];
        $categorias = Category::all();

        if (Auth::user()) {
            $usutarcod          = Auth::user()->usutarcod;
            $usuofecod          = Auth::user()->usuofecod;
            $articulosConPrecio = $this->articleService->calculatePrices($articulos, $usutarcod);
            if ($articulosOferta)
                $this->articleService->calculatePrices($articulosOferta, $usutarcod);
        }

        return view('pages.ecommerce.productos.products', compact('categorias', 'articulosOferta', 'articulos', 'catnom', 'favoritos', 'ofertas'));
    }
}
