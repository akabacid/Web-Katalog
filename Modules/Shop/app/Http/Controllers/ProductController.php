<?php

namespace Modules\Shop\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Modules\Shop\Repositories\Front\Interfaces\ProductRepositoryInterface;
use Modules\Shop\Repositories\Front\Interfaces\CategoryRepositoryInterface;

class ProductController extends Controller
{
    protected $productRepository;
    protected $categoryRepository;
    protected $defaultPriceRange;
    protected $sortingQuery;

    public function __construct(ProductRepositoryInterface $productRepository, CategoryRepositoryInterface $categoryRepository)
    {
        parent::__construct();

        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->defaultPriceRange = [
            'min' => '',
            'max' => '',
        ];

        $this->data['categories'] = $this->categoryRepository->findAll();
        $this->data['filter']['price'] = $this->defaultPriceRange;

        $this->sortingQuery = null;
        $this->data['sortingQuery'] = $this->sortingQuery;
        $this->data['sortingOptions'] = [
            '' => 'Urutkan Produk',
            '?sort=price&order=asc' => 'Harga: Terrendah ke Tertinggi',
            '?sort=price&order=desc' => 'Harga: Tertinggi ke Terrendah',
            '?sort=name&order=asc' => 'Nama: A to Z',
            '?sort=name&order=desc' => 'Nama: Z to A',
        ];
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $priceFilter = $this->getPriceRangeFilter($request);

        $options = [
            'per_page' => $this->perPage,
            'filter' => [
                'price' => $priceFilter,
            ],
        ];

        $this->data['products'] = $this->productRepository->findAll($options);

        if ($request->get('price')) {
            $this->data['filter']['price'] = $priceFilter;
        }

        if ($request->get('sort')) {
            $sort = $this->sortingRequest($request);
            $options['sort'] = $sort;

            $this->sortingQuery = '?sort=' . $sort['sort'] . '&order=' . $sort['order'];
            
            $this->data['sortingQuery'] = $this->sortingQuery;
        }

        if ($request->get('q')) {
            $q = $request->get('q');
            $options['filter']['q'] = $q; 
            $this->data['filter']['q'] = $q; 
        }
        
        $this->data['products'] = $this->productRepository->findAll($options);
        
        $maxPrice = (clone $this->data['products'])->max('price');

        return $this->loadTheme('products.index', $this->data)->with('maxPrice', $maxPrice);
    }

    public function category($categorySlug)
    {
        $category = $this->categoryRepository->findBySlug($categorySlug);

        $options = [
            'per_page' => $this->perPage,
            'filter' => [
                'category' => $categorySlug,
            ]
        ];

        $products = $this->productRepository->findAll($options);

        return view('themes.katalogtoko.products.category', [
            'categories' => $this->data['categories'],
            'category' => $category,
            'products' => $products,
            'maxPrice' => (clone $products)->max('price'),
            'filter' => $this->data['filter'],
            'sortingOptions' => $this->data['sortingOptions'],
            'sortingQuery' => $this->data['sortingQuery'] ?? '',
        ]);
    }
    

     public function show($categorySlug, $productSlug)
    {
        $product = $this->productRepository->findBySlug($productSlug);
        $this->data['product'] = $product;
        return $this->loadTheme('products.show', $this->data);
    }

    function getPriceRangeFilter($request)
    {
        $default = $this->defaultPriceRange;

        $priceString = $request->get('price');
        if (!$priceString) {
            return $default;
        }

        $prices = explode(' - ', $priceString);

        if (count($prices) !== 2 || !is_numeric($prices[0]) || !is_numeric($prices[1])) {
            return $default;
        }

        return [
            'min' => (int) $prices[0],
            'max' => (int) $prices[1],
        ];
    }

    function sortingRequest(Request $request) {
        $sort = [];

        if ($request->get('sort') && $request->get('order')) {
            $sort = [
                'sort' => $request->get('sort'),
                'order' => $request->get('order'),
            ];
        } else if ($request->get('sort')) {
            $sort = [
                'sort' => $request->get('sort'),
                'order' => 'desc',
            ];
        }

        return $sort;
    }
}