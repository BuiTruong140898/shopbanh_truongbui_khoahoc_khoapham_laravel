@extends('master')
@section('content')
	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">{{$loai_dang_xem->name}}</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="index.html">Home</a> / <span>Loại sản phẩm</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-3">
						<ul class="aside-menu">
							@foreach($loai as $loai)
								<li><a href="{{route('loaisanpham',$loai->id)}}">{{$loai->name}}</a></li>
							@endforeach
						</ul>
					</div>
					<div class="col-sm-9">
						<div class="beta-products-list">
							<h4>Sản phẩm bán chạy</h4>
							<div class="beta-products-details">
								<p class="pull-left">Tìm thấy {{count($sp_theoloai)}} sản phẩm</p>
								<div class="clearfix"></div>
							</div>

							<div class="row">

								@foreach($sp_theoloai as $sp_theoloai)

								<div class="col-sm-4">
									<div class="single-item">
										@if($sp_theoloai->promotion_price)	
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
									@endif
										<div class="single-item-header">
											<a href="{{route('chitietsanpham')}}"><img height="250px" src="source/image/product/{{$sp_theoloai->image}}" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$sp_theoloai->name}}</p>
											<p class="single-item-price">
												@if($sp_theoloai->promotion_price)
													<span class="flash-del">{{$sp_theoloai->unit_price}}đ</span>
													<span class="flash-sale">{{$sp_theoloai->promotion_price}}đ</span>
													
												@else
													<span class="flash-sale">{{$sp_theoloai->unit_price}}đ</span>
												@endif
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>

								@endforeach
					
							</div>
						</div> <!-- .beta-products-list -->

						<div class="space50">&nbsp;</div>

						<div class="beta-products-list">
							<h4>Sản phẩm khác</h4>
							<div class="beta-products-details">
								<p class="pull-left">Tìm thấy {{$sp_khac->total()}} sản phẩm</p>
								<div class="clearfix"></div>
							</div>
							<div class="row">

								@foreach($sp_khac as $sp_khac)

								<div class="col-sm-4">
									<div class="single-item">
										@if($sp_khac->promotion_price)	
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
									@endif
										<div class="single-item-header">
											<a href="{{route('chitietsanpham')}}"><img height="250px" src="source/image/product/{{$sp_khac->image}}" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$sp_khac->name}}</p>
											<p class="single-item-price">
												@if($sp_khac->promotion_price)
													<span class="flash-del">{{$sp_khac->unit_price}}đ</span>
													<span class="flash-sale">{{$sp_khac->promotion_price}}đ</span>
													
												@else
													<span class="flash-sale">{{$sp_khac->unit_price}}đ</span>
												@endif
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>


								@endforeach

							</div>

{{-- 							<div class='row'>{{$sp_khac->links()}}</div>
 --}}
							<div class="space40">&nbsp;</div>
							
						</div> <!-- .beta-products-list -->
					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection