<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li class="treeview"><a href="#"><i class="fa fa-lock"></i><span class="{{Lang::locale()=== 'kh'? 'kh-os' : 'arial'}}"> {{trans('label.administrator')}}</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
        <ul class="treeview-menu">
            <li class="treeview"><a href="#"><i class="fa fa-user fa-fw"></i><span class="{{Lang::locale()=== 'kh'? 'kh-os' : 'arial'}}">{{trans('label.user')}}</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::to('/admin/user')}}">&nbsp;&nbsp;&nbsp;&nbsp; <span class="{{Lang::locale()=== 'kh'? 'kh-os' : 'arial'}}">{{trans('label.add_new')}}</span></a></li><li class="treeview">
                    {{--<li><a href="#">&nbsp;&nbsp;&nbsp;&nbsp; Reset Login</a></li><li class="treeview">--}}
                    {{--<li><a href="#">&nbsp;&nbsp;&nbsp;&nbsp; Reset Password</a></li><li class="treeview">--}}
                </ul>
            </li>

            <li class="treeview"><a href="#"><i class="fa fa-users" aria-hidden="true"></i> <span class="{{Lang::locale()=== 'kh'? 'kh-os' : 'arial'}}">{{trans('label.position')}}</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('/admin/position/create')}}">&nbsp;&nbsp;&nbsp;&nbsp; <span class="{{Lang::locale()=== 'kh'? 'kh-os' : 'arial'}}">{{trans('label.add_new')}}</span></a></li><li class="treeview">
                </ul>
            </li>

            <li class="treeview"><a href="#"><i class="fa fa-language" aria-hidden="true"></i><span class="{{Lang::locale()=== 'kh'? 'kh-os' : 'arial'}}">{{trans('label.language')}}</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('language.create')}}">&nbsp;&nbsp;&nbsp;&nbsp; <span class="{{Lang::locale()=== 'kh'? 'kh-os' : 'arial'}}">{{trans('label.add_new')}}</span></a></li><li class="treeview">
                </ul>
            </li>

            <li class="treeview"><a href="#"><i class="fa fa-briefcase" aria-hidden="true"></i><span class="{{Lang::locale()=== 'kh'? 'kh-os' : 'arial'}}">{{trans('label.categoryproduct')}}</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('categoryproduct.create')}}">&nbsp;&nbsp;&nbsp;&nbsp; <span class="{{Lang::locale()=== 'kh'? 'kh-os' : 'arial'}}">{{trans('label.add_new')}}</span></a></li><li class="treeview">
                    <li><a href="{{route('categoryproduct.create')}}">&nbsp;&nbsp;&nbsp;&nbsp; <span class="{{Lang::locale()=== 'kh'? 'kh-os' : 'arial'}}">{{trans('label.add_new')}}</span></a></li>
                </ul>
            </li>
            
           <li class="treeview"><a href="#"><i class="fa fa-tag" aria-hidden="true"></i><span class="{{Lang::locale()=== 'kh'? 'kh-os' : 'arial'}}">{{trans('label.category')}}</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('category.create')}}">&nbsp;&nbsp;&nbsp;&nbsp; <span class="{{Lang::locale()=== 'kh'? 'kh-os' : 'arial'}}">{{trans('label.add_new')}}</span></a></li><li class="treeview">
                </ul>
           </li>

            <li class="treeview"><a href="#"><i class="fa fa-bold" aria-hidden="true"></i><span class="{{Lang::locale()=== 'kh'? 'kh-os' : 'arial'}}">{{trans('label.brand')}}</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('brand.create')}}">&nbsp;&nbsp;&nbsp;&nbsp; <span class="{{Lang::locale()=== 'kh'? 'kh-os' : 'arial'}}">{{trans('label.add_new')}}</span></a></li><li class="treeview"></li>
                </ul>
            </li>



            <li class="treeview"><a href="#"><i class="fa fa-tag" aria-hidden="true"></i><span class="{{Lang::locale()=== 'kh'? 'kh-os' : 'arial'}}">{{trans('label.client')}}</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('client.create')}}">&nbsp;&nbsp;&nbsp;&nbsp; <span class="{{Lang::locale()=== 'kh'? 'kh-os' : 'arial'}}">{{trans('label.add_new')}}</span></a></li><li class="treeview">
                </ul>
            </li>

        </ul>
    </li>


    {{--product--}}
    <li class="treeview">
        <a href="#"><i class="fa fa-product-hunt"></i><span> <span class="{{Lang::locale()=== 'kh'? 'kh-os' : 'arial'}}">{{trans('label.product')}}</span></span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
            {{--<span class="pull-right-container">--}}
            {{--<span class="label label-primary pull-right">4</span>--}}
            {{--</span>--}}
        </a>
        <ul class="treeview-menu">
            <li><a href="{{route('product.create')}}"><i class="fa fa-circle-o"></i><span class="{{Lang::locale()=== 'kh'? 'kh-os' : 'arial'}}">{{trans('label.add_new')}}</span></a></li>
            <li><a href="{{route('product.index')}}"><i class="fa fa-circle-o"></i><span class="{{Lang::locale()=== 'kh'? 'kh-os' : 'arial'}}">{{trans('label.view')}}</span></a></li>

        </ul>
    </li>
    {{--product--}}
</ul>
    {{--Article--}}
    <li class="treeview">
        <a href="#"><i class="fa fa-files-o"></i><span> <span class="{{Lang::locale()=== 'kh'? 'kh-os' : 'arial'}}">{{trans('label.article')}}</span></span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{route('article.create')}}"><i class="fa fa-circle-o"></i><span class="{{Lang::locale()=== 'kh'? 'kh-os' : 'arial'}}">{{trans('label.add_new')}}</span></a></li>
            <li><a href="{{route('article.index')}}"><i class="fa fa-circle-o"></i><span class="{{Lang::locale()=== 'kh'? 'kh-os' : 'arial'}}">{{trans('label.view')}}</span></a></li>
        </ul>
    </li>
    {{--end article--}}
</ul>