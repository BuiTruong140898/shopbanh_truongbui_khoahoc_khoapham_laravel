@extends('master')
@section('content')
		<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="beta-products-list">
							<h4>Kết quả tìm kiếm</h4>
							<div class="beta-products-details">
								<p class="pull-left">Tìm thấy {{count($ketquatimkiem)}} sản phẩm</p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
								
								@foreach($ketquatimkiem as $kqtk)
								
								<div class="col-sm-3">
									<div class="single-item">
									@if($kqtk->promotion_price)	
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
									@endif
										<div class="single-item-header">
											<a href="{{route('chitietsanpham',$kqtk->id)}}"><img height="250px" src="source/image/product/{{$kqtk->image}}" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$kqtk->name}}</p>
											<p class="single-item-price">
												@if($kqtk->promotion_price)
													<span class="flash-del">{{$kqtk->unit_price}}đ</span>
													<span class="flash-sale">{{$kqtk->promotion_price}}đ</span>
													
												@else
													<span class="flash-sale">{{$kqtk->unit_price}}đ</span>
												@endif

											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="{{route('themvaogiohang',$kqtk->id)}}"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{route('chitietsanpham',$kqtk->id)}}">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>

								@endforeach

							</div>

							{{-- <div class='row'>{{$ketquatimkiem->links()}}</div> --}}

						</div> <!-- .beta-products-list -->

						<div class="space50">&nbsp;</div>

						
					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection