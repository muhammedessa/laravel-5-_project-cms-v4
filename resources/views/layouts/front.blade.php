@include('include.header')

		<!-- PAGE HEADER -->
		<div class="page-header">
			<div class="page-header-bg" style="background-image: url('{{$post->featrued}}');" data-stellar-background-ratio="0.5"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-offset-1 col-md-10 text-center">
						<h1 class="text-uppercase">{{$title}}</h1>
						<p class="lead">{{$post->category->name}}</p>
					</div>
				</div>
			</div>
		</div>
		<!-- /PAGE HEADER -->
	</header>
	<!-- /HEADER -->

	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-8">


						<div class="section-row">
								<div class="section-title">
									<h3 class="title">User info</h3>
								</div>
		
		
								<h1>{{$post->user->name}}</h1>

								
								<ul class="contact-social">
										@if ($post->user->profile->facebook != '' )
										<li><a href="{{$post->user->profile->facebook}}" class="social-facebook"><i class="fa fa-facebook"></i></a></li>
										@endif
										@if ($post->user->profile->twitter != '' )
										<li><a href="{{$post->user->profile->twitter}}" class="social-twitter"><i class="fa fa-twitter"></i></a></li>
										@endif
										@if ($post->user->profile->github != '' )
										<li><a href="{{$post->user->profile->github}}" class="social-google-plus"><i class="fa fa-google-plus"></i></a></li>
										@endif
									</ul>

								 
								<p>{!! $post->user->profile->about !!}</p>
								 
							 </div>



					<div class="section-row">
						<div class="section-title">
							<h3 class="title">{{$title}}</h3>
						</div>


						<h1>{{$post->created_at->toFormattedDateString()}}</h1>
						<p>{!! $post->content !!}</p>
						@foreach($post->tags as $tag)
						<a href="{{route('tag.show', ['id' => $tag->id])}}" 
							class="badge badge-pill badge-danger"
						style="background-color: #ee4266;">{{ $tag->tag }}</a>
						@endforeach
				     </div>
							 

					 <div class="section-row">
							<div class="section-title">
								 
							</div>
							 <br>

							 @if ($prev)
							 <a href="{{route('post.show', ['slug' => $prev->slug])}}" 
								 class="badge badge-danger"> Next => {{$prev->title}} </a>
							 @endif

							 @if ($next)
							 <a href="{{route('post.show', ['slug' => $next->slug])}}" 
								 class="badge badge-danger"> Prev => {{$next->title}} </a>
							 @endif
							 
						  
						 </div>

						 <div class="section-row">
								<div class="section-title">
										<h3 class="title">All Tags</h3>	 
								</div>
								 <br>
	
							
						@foreach($tags as $tag)
						<a href="{{route('tag.show', ['id' => $tag->id])}}" class="badge badge-pill badge-danger"
						style="background-color: #ee4266;">{{ $tag->tag }}</a>
						@endforeach
	  
								 
							  
							 </div>


						@include('include.disqus') 

				</div>











				
				<div class="col-md-4">
					<!-- social widget -->
					<div class="aside-widget">
						<div class="section-title">
							<h2 class="title">Social Media</h2>
						</div>
						<div class="social-widget">
							<ul>
								<li>
									<a href="#" class="social-facebook">
										<i class="fa fa-facebook"></i>
										<span>21.2K<br>Followers</span>
									</a>
								</li>
								<li>
									<a href="#" class="social-twitter">
										<i class="fa fa-twitter"></i>
										<span>10.2K<br>Followers</span>
									</a>
								</li>
								<li>
									<a href="#" class="social-google-plus">
										<i class="fa fa-google-plus"></i>
										<span>5K<br>Followers</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<!-- /social widget -->

					<!-- newsletter widget -->
					<div class="aside-widget">
						<div class="section-title">
							<h2 class="title">Newsletter</h2>
						</div>
						<div class="newsletter-widget">
							<form>
								<p>Nec feugiat nisl pretium fusce id velit ut tortor pretium.</p>
								<input class="input" name="newsletter" placeholder="Enter Your Email">
								<button class="primary-button">Subscribe</button>
							</form>
						</div>
					</div>
					<!-- /newsletter widget -->
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

	@include('include.footer')

	<!-- jQuery Plugins -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.stellar.min.js"></script>
	<script src="js/main.js"></script>
	<!-- Go to www.addthis.com/dashboard to customize your tools --> <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5c40572051e6064d"></script>
</body>

</html>
