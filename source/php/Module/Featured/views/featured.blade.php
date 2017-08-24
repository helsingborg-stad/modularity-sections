<section class="section section-featured background-4 {{ $classes }}" style="background-image: url({{ $backgroundImage }}); ">
    <div class="container">
     <div class="grid">
         <div class="grid-xs-12">
                 <article class="section-article">
                     <div class="grid content-grid">
                         <div class="section-image grid-xs-12 grid-lg-4 text-center">
                             <i class="pricon pricon-construction"></i>
                         </div>
                         <div class="section-text grid-xs-12 grid-lg-8">
                            {!! $content !!}
                         </div>
                     </div>
                 </article>
         </div>
     </div>
     {!! $submoduleRendered !!}
    </div>
</section>
