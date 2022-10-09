<?php   
        
    namespace App\Http\Controllers\Superadmin;  
        
    use Illuminate\Http\Request;    
    use App\Http\Controllers\Controller;    
    use App\Models\Common;
    use App\Models\User;
    use App\Models\Seller;
    use App\Models\Customer;
    use App\Models\Order;
    use App\Models\Products;
    use App\Exports\TopProductsOrder;
    use App\Exports\StoreDependProductPriceListExport;
    use App\Exports\AreaBasedCustomer;
    use App\Exports\CustomerOrdersTotal;
    use Maatwebsite\Excel\Facades\Excel;
    use DB;
        
    class SuperadminDataAnalytics extends Controller    
    {       
        protected $datas = array();     
        /**             
            * Contructor to aunthendicate user          
        */      
            
                
        /**         
            * Display a listing of the resource.            
            *           
            * @return \Illuminate\Http\Response         
        */      
                
        public function index(Request $request){            


            $this->data['highest_sale'] = Order::select(
                'orders.*','product.*',
                'customer.name as customer',
                'product_name as product'               
                )
            ->leftjoin('customer','customer.id','orders.customer_id')
            ->leftjoin('product','product.product_id','orders.product_id')
            ->orderBy('total', 'desc')
            ->groupby('product')
            ->where('total','!=', NULL) 
            ->get();

            $this->data['top_products_order'] = Order::select('product.product_name',DB::raw('count(product.product_name) as product_count'))
            ->leftjoin('product','product.product_id','orders.product_id')
            ->groupby('orders.product_id')
            ->orderBy('product_count', 'desc')
            ->get();

            $this->data['store_depend_product_price_list'] = Products::select('product.*','brand.*','seller_details.*','product_quantity.*')
            ->leftjoin('brand','brand.id','product.brand_id')
            ->leftjoin('seller_details','seller_details.sd_usid','product.seller_id')
            ->leftjoin('product_quantity','product_quantity.product_id','product.product_id')
            ->get(); 

            $this->data['area_based_customer'] = Customer::select('customer.*','customer_addresses.*')
            ->leftjoin('customer_addresses','customer_addresses.customer_id','customer.id')
            ->get(); 

            $this->data['repeat_buyers'] = Order::select('customer.*','orders.*','customer.name as customer_name')
            ->leftjoin('customer','customer.id','orders.customer_id')
            ->groupby('customer.name')
            ->orderBy('name', 'desc')
            ->get(); 

            $this->data['order_product'] = Order::select(
                'product.*','orders.*','seller_details.*',
                'product.product_name as product',
                'orders.total as total'
                )
            ->leftjoin('product','product.product_id','orders.product_id')
            ->leftjoin('seller_details','seller_details.sd_id','orders.store_id')
            ->orderBy('created_at','desc')
            ->take(10)
            ->get(); 

            $this->data['top_orders_in_areas'] = Seller::select('seller_details.*','orders.*','seller_details.sd_address as addresses', 'product.product_name as product','orders.total as total')          
            ->leftjoin('orders','seller_details.sd_id','orders.store_id')
            ->leftjoin('product','seller_details.sd_usid','product.product_id')
            ->orderBy('sd_address', 'desc')         
            ->take(10)
            ->get();

            $this->data['customer_order_total'] = Order::select('customer.*','orders.*','orders.customer_id',DB::raw('count(orders.customer_id) as customer_count'),DB::raw("SUM(total)"))
            ->leftjoin('customer','customer.id','orders.customer_id')
            ->groupby('customer.name')
            ->orderBy('customer_count', 'desc')
            ->get();

            $this->data['senddata'] = User::get();
            
            return view('superadmin.data_analytics.manage',$this->data);         
        }   

        public function export_top_products_order(Request $request){

            return Excel::download(new TopProductsOrder(), 'top_products_order.csv');

        }   

        public function export_store_depend_product_price_list(Request $request){

            return Excel::download(new StoreDependProductPriceListExport(), 'store_depend_product_price_list.csv');

        }   

        public function export_area_based_customer(Request $request){

            return Excel::download(new AreaBasedCustomer(), 'area_based_customer.csv');

        }

         public function export_customer_orders_total(Request $request){

            return Excel::download(new CustomerOrdersTotal(), 'customer_orders_total.csv');

        }
                
        /**         
            * Show the form for creating a new resource.            
            *           
            * @return \Illuminate\Http\Response         
        */      
        public function create()        
        {           
            //          
        }       
                
        /**         
            * Store a newly created resource in storage.            
            *           
            * @param  \Illuminate\Http\Request  $request            
            * @return \Illuminate\Http\Response         
        */      
        public function store(Request $request)     
        {           
            //          
        }       
                
        /**         
            * Display the specified resource.           
            *           
            * @param  int  $id          
            * @return \Illuminate\Http\Response         
        */      
        public function show($id)       
        {           
            //          
        }       
                
        /**         
            * Show the form for editing the specified resource.         
            *           
            * @param  int  $id          
            * @return \Illuminate\Http\Response         
        */      
        public function edit($id)       
        {           
            //          
        }       
                
        /**         
            * Update the specified resource in storage.         
            *           
            * @param  \Illuminate\Http\Request  $request            
            * @param  int  $id          
            * @return \Illuminate\Http\Response         
        */      
        public function update(Request $request, $id)       
        {           
            //          
        }       
                
        /**         
            * Remove the specified resource from storage.           
            *           
            * @param  int  $id          
            * @return \Illuminate\Http\Response         
        */      
        public function destroy($id)        
        {           
            //          
        }       
    }   
