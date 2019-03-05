@extends('default')

@section('content')
    <div class="page-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <a href="/home"><i class="fa fa-home"></i>&nbsp;Home</a>
                        <span class="crumbs-spacer"><i class="fa fa-angle-double-right"></i></span>
                        <span class="current">FAQs</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section id="content">
        <div class="contact-info">
            <div class="container-fluid">
                <div id="faqs" class="faqs col-12">
                    <div id="faqs-list" class="fancy-title title-bottom-border">
                        <h3>Questions and Answers:</h3>
                    </div>
                    <ul class="iconlist faqlist">
                        <li><i class="fa fa-caret-right"></i><strong><a href="#" data-scrollto="faq-1">What is granite?</a></strong></li>
                        <li><i class="fa fa-caret-right"></i><strong><a href="#" data-scrollto="faq-2">What is Lorem Ipsum?</a></strong></li>
                        <li><i class="fa fa-caret-righlt"></i><strong><a href="#" data-scrollto="faq-3">Why do we use it?</a></strong></li>
                        <li><i class="fa fa-caret-right"></i><strong><a href="#" data-scrollto="faq-4">Where does it come from?</a></strong></li>
                        <li><i class="fa fa-caret-right"></i><strong><a href="#" data-scrollto="faq-5">Where can I get some?</a></strong></li>
                    </ul>
                    <div class="divider"><i class="fa fa-circle"></i></div>
                    <h3 id="faq-1" ><strong>Q.</strong> What is granite?</h3>
                    <p>Granite is an organic, beautiful, and elegant choice that most modern homes and kitchens implement to bring a fresh, classy, updated, and clean look. Granite is a coarse-grained mineral, hence the word “grain” embedded in granite that formed in magma as igneous rock. </p>
                    <p>Don’t think that because granite is a mineral, it only comes in grey or black. Granite also comes in red and yellow as well, depending on where the granite was formed and the amount of pressure and heat introduced to the rock during formation.</p>
                    <p>Because granite like most rocks, is porous, granite needs to be sealed properly in order to maintain the smooth, glossy surface that Urban Countertops provides post-installation. Without proper sealing and maintenance, damaging oils and water can seep into the porous surface and damage your perfect counters.
                    </p>
                    <div class="divider divider-right"><a href="#" data-scrollto="#faqs-list"><i class="fa fa-chevron-up"></i></a></div>
                    <h3 id="faq-2"><strong>Q.</strong> What is Lorem Ipsum?</h3>
                    <p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    <div class="divider divider-right"><a href="#" data-scrollto="#faqs-list"><i class="fa fa-chevron-up"></i></a></div>
                    <h3 id="faq-3"><strong>Q.</strong> Why do we use it?</h3>
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                    <div class="divider divider-right"><a href="#" data-scrollto="#faqs-list"><i class="fa fa-chevron-up"></i></a></div>
                    <h3 id="faq-4" ><strong>Q.</strong> Where does it come from?</h3>
                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. </p>
                    <div class="divider divider-right"><a href="#" data-scrollto="#faqs-list"><i class="fa fa-chevron-up"></i></a></div>
                    <h3 id="faq-5"><strong>Q.</strong> Where can I get some?</h3>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
                    <div class="divider divider-right"><a href="#" data-scrollto="#faqs-list"><i class="fa fa-chevron-up"></i></a></div>
                </div>
            </div>
        </div>
    </section>
    <style>
        @media (min-width: 1281px) {
            #faqs{
                padding:0 100px;
            }
        }

        @media (min-width: 1025px) and (max-width: 1280px) {
            #faqs{
                padding:0 100px;
            }
        }
    </style>
@endsection
