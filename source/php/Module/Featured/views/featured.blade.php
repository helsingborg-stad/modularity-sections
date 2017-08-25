<section class="section section-featured background-4 {{ $classes }}" style="background-color: {{ $backgroundColor }}; background-image: url({{ $backgroundImage }}); ">
    <div class="container">
     <div class="grid">
         <div class="grid-xs-12">
                 <article class="section-article">
                     <div class="grid content-grid">
                         <div class="section-image grid-xs-12 grid-lg-4 text-center">
                            @if(is_numeric($foregroundImage))
                                {!! wp_get_attachment_image($foregroundImage, 'large', "", array( "class" => "img-responsive" )) !!}
                            @endif
                         </div>
                         <div class="section-text grid-xs-12 grid-lg-8">
                            {!! $content !!}
                         </div>
                     </div>
                 </article>
         </div>
     </div>

    </div>

    @if(is_array($submodules) && !empty($submodules))
        <div class="container section-submodules">
            {!! $submoduleRendered !!}
        </div>
    @endif
</section>
