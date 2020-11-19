<!DOCTYPE html>
<html>
<head>
	<title>slide</title>
	<!-- TailwindCss -->
	<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
	<!-- Jquery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ==" crossorigin="anonymous"></script>
	<!-- OwlCarousel2 -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
</head>
<body>
	<div class="w-auto h-auto">
		<div class="owl-carousel">
			@foreach($article as $art)
			<div style="height:800px;width:100%;background-image:url({{ $art->image }});background-size:cover;background-repeat:no-repeat;">
				<a href="#">{{ Str::words($art->title, 2, '') }}</a>
				<a href="#">{{ Str::words($art->article, 2, '.....') }}</a>
			</div>
			@endforeach
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function () {
			$('.owl-carousel').owlCarousel({
				loop: true,
				autoplay: true,
				items: 1,
			});
		});
	</script>
</body>
</html>