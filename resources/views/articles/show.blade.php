@extends('layouts.app')

@section('content')
<header-component title="{{ $article->title }}"
                    description="{{ $article->excerpt }}"
                    url="#post-content"
                    link="@lang('Read More')"></header-component>
    @include('layouts.breadcrumb')
<!-- Main Content -->
<section class="section primary blog-post">
  <div class="container small-container">
    <header class="sep active">
      <div class="section-title">
        <h2>{{ $article->title }}</h2>
        <ul class="article-meta">
          <li>
            <i class="fa fa-user"></i> @lang('Posted by:')
            <a href="{{ route('articlesBy', ['user' => $article->user]) }}">
              {{ $article->user->name }}
            </a>
          </li>
          <li><i class="fa fa-folder"></i> @lang('Category:')
            <a href="{{ route('category', ['category' => $article->category]) }}">
              {{ $article->category->name }}
            </a>
          </li>
          <li><i class="fa fa-calendar"></i> @lang('Posted:') {{ $article->created_at->calendar() }}</li>
        </ul>
      </div>
    </header>
    <div class="article-meta">
      <a href="assets/images/stock13.jpg" class="modal-image thumb">
        <img src="assets/images/stock13.jpg" alt="" />
      </a>

      <a href="assets/images/stock17.jpg" class="modal-image profile profile-border">
        <img src="assets/images/stock17.jpg" alt="" />
      </a>
    </div>
    <div class="article-content" id="article-content">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. <a href="#">Inquit, dasne adolescenti veniam?</a>
        Ergo instituto veterum, quo etiam Stoici utuntur, hinc capiamus exordium. Quarum ambarum rerum cum medicinam
        pollicetur, luxuriae licentiam pollicetur. Duo Reges: constructio interrete. Docent enim nos, ut scis,
        dialectici, si ea quae rem aliquam sequantur, falsa sint.</p>

      <p>Falsam illam ipsam esse, quam sequantur. Universa enim illorum ratione cum tota vestra confligendum puto.
        Perturbationes autem nulla naturae <b>vi commoventur, omniaque ea sunt opiniones</b> ac iudicia levitatis.
        <a href="#">Haec dicuntur inconstantissime.</a> Restinguet citius, si ardentem acceperit. Quae sequuntur
        igitur? Quicquid enim a sapientia proficiscitur, id continuo debet expletum esse omnibus suis partibus; Quod
        non subducta utilitatis ratione effici solet, sed ipsum a se oritur et sua sponte nascitur. Non enim solum
        Torquatus dixit quid sentiret, sed etiam cur. </p>

      <p>Nullis enim partitionibus, nullis definitionibus utuntur ipsique dicunt ea se modo probare, quibus natura
        tacita adsentiatur. Quacumque enim ingredimur, in aliqua historia vestigium ponimus. Quae sunt igitur
        communia vobis cum antiquis, iis sic utamur quasi concessis. Immo alio genere. </p>

      <p>Mihi vero, inquit, placet agi subtilius et, ut ipse dixisti, pressius. Idemne, quod iucunde? Qua ex
        cognitione facilior facta est investigatio rerum occultissimarum. Paria sunt igitur. <i>Graece donan, Latine
          voluptatem vocant.</i> <a href="#">Quod equidem non reprehendo;</a> <b>Scrupulum, inquam, abeunti;</b> Sed
        virtutem ipsam inchoavit, nihil amplius. Similiter sensus, cum accessit ad naturam, tuetur illam quidem, sed
        etiam se tuetur; </p>

      <blockquote>
        <p>An vero, inquit, quisquam potest probare, quod perceptfum, quod.</p>
      </blockquote>

      <p>Quis non odit sordidos, vanos, leves, futtiles? Quid censes eos esse facturos, qui omnino virtutem a
        bonorum fine segregaverunt, Epicurum, Hieronymum, illos etiam, si qui Carneadeum finem tueri volunt?
        <b>Virtutibus igitur rectissime</b> mihi videris et ad consuetudinem nostrae orationis vitia posuisse
        contraria. Ita fit beatae vitae domina fortuna, quam Epicurus ait exiguam intervenire sapienti. <a
          href="#">Sed ego in hoc resisto;</a> Si longus, levis; Satisne vobis videor pro meo iure in vestris
        auribus commentatus? <a href="#">Satis est ad hoc responsum</a>. In qua si nihil est praeter rationem, sit
        in una virtute finis bonorum; Traditur, inquit, ab Epicuro ratio neglegendi doloris. </p>

      <p>Modo etiam paulum ad dexteram de via declinavi, ut ad Pericli sepulcrum accederem. In motu et in statu
        corporis nihil inest, quod animadvertendum esse ipsa natura iudicet? <a href="#">Ita nemo beato beatior.</a>
        Mihi autem nihil tam perspicuum videtur, quam has sententias eorum philosophorum re inter se magis quam
        verbis dissidere; Quacumque enim ingredimur, in aliqua historia vestigium ponimus. Quae sunt igitur communia
        vobis cum antiquis, iis sic utamur quasi concessis; Quod non faceret, si in voluptate summum bonum poneret.
        Qua tu etiam inprudens utebare non numquam. </p>
    </div>
    <div class="article-author">
      <header>
        <div class="section-title">
          <h4><span>The <i>Author</i></span></h4>
        </div>
      </header>
      <a href="assets/images/stock17.jpg" class="modal-image profile profile-border">
        <img src="assets/images/stock17.jpg" alt="" />
      </a>
      <div class="author-content">
        <h4><a href="blog.html">Jane Doe</a></h4>
        <h5>Graphic Designer</h5>
        <p>Nunc pharetra et massa eu volutpat. Duis at posuere justo. Vivamus lobortis mi at leo pellentesque
          vehicula. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam
          erat volutpat. Proin ac augue quam. Etiam sollicitudin magna vitae nunc accumsan cursus.</p>
      </div>
    </div>
    <div class="social-share metro-blocks">
      <ul>
        <li class="metro-block facebook">
          <a href="#">
            <div class="social-share-overlay">
              <i class="fa fa-facebook"></i>
            </div>
            <div class="share-amount">
              <div>346</div>
              <div>Shares</div>
            </div>
            <span>Facebook</span>
          </a>
        </li>
        <li class="metro-block twitter">
          <a href="#">
            <div class="social-share-overlay">
              <i class="fa fa-twitter"></i>
            </div>
            <div class="share-amount">
              <div>128</div>
              <div>Shares</div>
            </div>
            <span>Twitter</span>
          </a>
        </li>
        <li class="metro-block google-plus">
          <a href="#">
            <div class="social-share-overlay">
              <i class="fa fa-google-plus"></i>
            </div>
            <div class="share-amount">
              <div>487</div>
              <div>Shares</div>
            </div>
            <span>Google Plus</span>
          </a>
        </li>
        <li class="metro-block rss">
          <a href="#">
            <div class="social-share-overlay">
              <i class="fa fa-rss"></i>
            </div>
            <div class="share-amount">
              <div>1024</div>
              <div>Shares</div>
            </div>
            <span>RSS</span>
          </a>
        </li>
        <li class="metro-block reddit">
          <a href="#">
            <div class="social-share-overlay">
              <i class="fa fa-reddit"></i>
            </div>
            <div class="share-amount">
              <div>76</div>
              <div>Shares</div>
            </div>
            <span>Reddit</span>
          </a>
        </li>
        <li class="metro-block email">
          <a href="#">
            <div class="social-share-overlay">
              <i class="fa fa-envelope"></i>
            </div>
            <div class="share-amount">
              <div>544</div>
              <div>Shares</div>
            </div>
            <span>Email</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</section>
<section class="section primary comments">
  <div class="container">

    <hr class="stripes large no-mt" />

    <header class="sep active">
      <div class="section-title">
        <h2>Post <i>Comments</i></h2>
      </div>
    </header>

    <div class="comments-wrapper">

      <article class="comment">
        <a href="assets/images/stock16.jpg" class="modal-image profile profile-border">
          <img src="assets/images/stock16.jpg" alt="" />
        </a>
        <div class="comment-content">
          <h4>John Doe</h4>
          <span class="article-date">
            <i class="fa fa-calendar"></i> <span>Posted:</span> Today, 9:16pm
          </span>
          <p>Nunc pharetra et massa eu volutpat. Duis at posuere justo. Vivamus lobortis mi at leo pellentesque
            vehicula. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam
            erat volutpat. Proin ac augue quam. Etiam sollicitudin magna vitae nunc accumsan cursus.</p>
        </div>
        <a class="button small round report" href="#">Report</a>
        <a class="button small round reply" href="#new-comment">Reply</a>
      </article>

      <article class="comment comment-reply">
        <a href="assets/images/stock17.jpg" class="modal-image profile profile-border">
          <img src="assets/images/stock17.jpg" alt="" />
        </a>
        <div class="comment-content">
          <h4>Jane Dough</h4>
          <span class="article-date">
            <i class="fa fa-calendar"></i> <span>Posted:</span> Today, 10:20pm
          </span>
          <p>Nunc pharetra et massa eu volutpat. Duis at posuere justo. Vivamus lobortis mi at leo pellentesque
            vehicula. Cum sociis natoque penatibus et magnis dis parturient.</p>
        </div>
        <a class="button small round report" href="#">Report</a>
        <a class="button small round reply" href="#new-comment">Reply</a>
      </article>

      <article class="comment">
        <a href="assets/images/stock18.jpg" class="modal-image profile profile-border">
          <img src="assets/images/stock18.jpg" alt="" />
        </a>
        <div class="comment-content">
          <h4>Sam Tho</h4>
          <span class="article-date">
            <i class="fa fa-calendar"></i> <span>Posted:</span> Today, 6:30pm
          </span>
          <p>Pellentesque tincidunt sem lorem, eget auctor mauris eleifend sit amet. Ut vel consequat arcu. Donec
            semper vestibulum varius. Donec placerat mollis sem non pretium. Aenean gravida hendrerit libero, vitae
            fringilla est vestibulum non. Pellentesque posuere mi ac risus fermentum rutrum.</p>

          <p>Quisque id justo euismod lorem efficitur rutrum sit amet a quam. Maecenas quis blandit est. In iaculis
            orci diam, sed vehicula lectus mollis eget. Donec aliquet non magna id gravida. Duis convallis felis id
            mauris tincidunt, et consequat dolor tincidunt. Vivamus dictum, ante et consectetur varius, nunc sapien
            pellentesque nulla, non ornare ipsum justo ut erat. Curabitur mi turpis, fermentum id semper quis,
            convallis eget elit.</p>
        </div>
        <a class="button small round report" href="#">Report</a>
        <a class="button small round reply" href="#new-comment">Reply</a>
      </article>

      <article class="comment">
        <a href="assets/images/stock16.jpg" class="modal-image profile profile-border">
          <img src="assets/images/stock16.jpg" alt="" />
        </a>
        <div class="comment-content">
          <h4>John Doe</h4>
          <span class="article-date">
            <i class="fa fa-calendar"></i> <span>Posted:</span> Today, 12:33pm
          </span>
          <p>Nunc pharetra et massa eu volutpat. Duis at posuere justo.</p>
        </div>
        <a class="button small round report" href="#">Report</a>
        <a class="button small round reply" href="#new-comment">Reply</a>
      </article>

      <article class="comment hidden-comment">
        <a href="assets/images/stock18.jpg" class="modal-image profile profile-border">
          <img src="assets/images/stock18.jpg" alt="" />
        </a>
        <div class="comment-content">
          <h4>Sam Tho</h4>
          <span class="article-date">
            <i class="fa fa-calendar"></i> <span>Posted:</span> Today, 6:30pm
          </span>
          <p>Nunc pharetra et massa eu volutpat. Duis at posuere justo. Vivamus lobortis mi at leo pellentesque
            vehicula. Cum sociis natoque penatibus et magnis dis parturient.</p>
        </div>
        <a class="button small round report" href="#">Report</a>
        <a class="button small round reply" href="#new-comment">Reply</a>
      </article>

      <article class="comment hidden-comment comment-reply">
        <a href="assets/images/stock17.jpg" class="modal-image profile profile-border">
          <img src="assets/images/stock17.jpg" alt="" />
        </a>
        <div class="comment-content">
          <h4>Jane Dough</h4>
          <span class="article-date">
            <i class="fa fa-calendar"></i> <span>Posted:</span> Today, 10:20pm
          </span>
          <p>Quisque id justo euismod lorem efficitur rutrum sit amet a quam. Maecenas quis blandit est. In iaculis
            orci diam, sed vehicula lectus mollis eget. Donec aliquet non magna id gravida. Duis convallis felis id
            mauris tincidunt, et consequat dolor tincidunt. Vivamus dictum, ante et consectetur varius, nunc sapien
            pellentesque nulla, non ornare ipsum justo ut erat. Curabitur mi turpis, fermentum id semper quis,
            convallis eget elit.</p>
        </div>
        <a class="button small round report" href="#">Report</a>
        <a class="button small round reply" href="#new-comment">Reply</a>
      </article>

      <article class="comment hidden-comment">
        <a href="assets/images/stock16.jpg" class="modal-image profile profile-border">
          <img src="assets/images/stock16.jpg" alt="" />
        </a>
        <div class="comment-content">
          <h4>John Doe</h4>
          <span class="article-date">
            <i class="fa fa-calendar"></i> <span>Posted:</span> Today, 9:16pm
          </span>
          <p>Nunc pharetra et massa eu volutpat. Duis at posuere justo. Vivamus lobortis mi at leo pellentesque
            vehicula. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam
            erat volutpat. Proin ac augue quam. Etiam sollicitudin magna vitae nunc accumsan cursus.</p>
        </div>
        <a class="button small round report" href="#">Report</a>
        <a class="button small round reply" href="#new-comment">Reply</a>
      </article>

      <div class="load-more-wrapper">
        <a class="button brand-1 round load-more">Load More</a>
      </div>

    </div>

    <div class="new-comment" id="new-comment">
      <header>
        <div class="section-title">
          <h4><span>Post A <i>Response</i></span></h4>
        </div>
      </header>
      <form class="h5-valid">
        <fieldset>
          <div class="form-element">
            <input type="text" class="box" required>
            <label>Name</label>
          </div>
          <div class="form-element">
            <input type="email" class="box" required>
            <label>Email Address</label>
          </div>
        </fieldset>
        <div class="form-element">
          <textarea class="box" placeholder="Enter your message" required></textarea>
        </div>
        <button type="submit" class="button full-width brand-1">Submit Message</button>
      </form>
    </div>

    <hr class="stripes large no-mb" />

  </div>
</section>
{{-- Related posts here --}}
@include('partials.banner')
@endsection
