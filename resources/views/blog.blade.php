@extends('main')
@section('content')
    <style>
        .single-product {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            padding: 10px;
            background-color: white;
        }

        .single-product:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        .changed {
            background: linear-gradient(to bottom, #013a20 0%, #478c5c 100%);
            padding: 180px;
        }

        .customed {
            margin: -20% auto 20px auto;
        }

        @media(max-width:1517px) {
            .changed {
                padding: 150px;
            }

            .customed {
                margin: -22% auto 20px auto
            }
        }

        @media(max-width:1199px) {
            .customed {
                margin: -30% auto 20px auto
            }
        }

        @media(max-width:850px) {
            .changed {
                padding: 150px;
            }

            .customed {
                margin: -42% auto 20px auto
            }
        }

        @media(max-width:600px) {
            .changed {
                display: none
            }

            .customed {
                margin: -0% auto 20px auto;
            }

            .kastem {
                background: linear-gradient(to left, #013a20 0%, #478c5c 100%);
                padding-bottom: 25px
            }
        }

        .rightside {
            margin-top: -200px
        }

        .deskripsi {
            text-align: justify;
        }

        .hero {
            border-radius: 6px;
            box-shadow: 5px 5px 5px rgba(250, 128, 114, 0.219);
        }

        .artikel .card {
            box-shadow: 5px 5px 5px #013a203a;
        }

        @media(max-width:1549px) {
            .rightside {
                margin-top: 0px
            }
        }

        @media(max-width:991px) {
            .leftside {
                display: none
            }
        }

    </style>
    <!-- Start Cowndown Area -->
    <div class="breadcrumbs" style="padding: 10px; background: linear-gradient(to left, #013a20 0%, #478c5c 100%);">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list text-white" id="catlist">
                            <li><a href="/" class="text-white">Home<i class="ti-arrow-right text-white"></i></a></li>
                            <i class="fa fa-tools text-white"></i> About Reworked Clothes <i class="fa fa-tools text-white pr-5"></i>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="artikel mb-5 mt-5">
        <div class="container">
            <div class="section-title">
                <h2>About Reworked Clothes</h2>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-5">
                        <img src="images/hero.jpg" alt="" class="hero">
                        <div class="artikel mt-5">
                            <h4>What Does “Sustainable Fashion” Mean?</h4>
                            <div class="text-muted mt-3 deskripsi">
                                <p>Sustainable fashion essentially refers to garments and accessories that are produced and/or accessed in an ecologically and socially responsible manner.</p>
                                <p>The reason that the word “accessed” is in this sustainable fashion definition is that the term should not be limited to making or buying new things. While sustainability marketing campaigns have led us to believe that we can buy our way to sustainability, it’s not that simple.</p>
                                <p>We can certainly choose to shop in a more sustainable way, but getting involved with sustainable fashion does not require buying anything new.</p>
                                <p>Wearing what you have, shopping secondhand, and swapping/borrowing from friends are other ways to engage in the sustainable fashion movement that doesn’t require the production or purchasing of anything new.</p>
                            </div>
                        </div>
                        <div class="artikel mt-5">
                            <h4>Where to start?</h4>
                            <div class="row text-muted mt-3">
                                <div class="col-lg-4">
                                    <h5 class="text-center">CLOTHING SWAP</h5>
                                    <div class="parag text-justify">
                                        <p class="mt-2">To start off with great(!) and probably the most sustainable solution because you are not only giving the pieces you get a new life, but also the ones you give away = double the save from landfill.</p>
                                        <p class="mt-2">Organizing a swap event can be time-consuming, but check out our article on how to run a revolving closet for a list of platforms which simplify clothing swaps. </p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <h5 class="text-center">SECOND HAND</h5>
                                    <div class="parag text-justify">
                                        <p class="mt-2">Another super sustainable solution because the pieces already exist, so you are saving the entire negative impact of production.</p>
                                        <p class="mt-2">The downside: buying second hand can give unconscious consumers who sell their clothes less incentive to think about their purchases, which fuels more fast fashion consumption.</p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <h5 class="text-center">SLOW FASHION</h5>
                                    <div class="parag text-justify">
                                        <p class="mt-2"> Environmentally friendly by producing fewer new items.</p>
                                        <p class="mt-2">If you really want to find a con here's one: slow fashion means sticking with what you have for a long time, so this can get difficult to practice when your tastes change</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="artikel mt-5">
                            <h5>What Are the Benefits of Sustainable Fashion?</h5>
                            <div class="text-muted deskripsi mt-3">
                                <p>With the industry responsible for 8-10% of global carbon emissions, fixing fashion can also mean making significant progress on decarbonization and reaching global climate goals. Cleaning up the fashion supply chain can also mean significantly reducing pollution in many communities around the world. Sourcing textiles for fashion from regenerative fiber systems can put us on a pathway to restoring the planet and our relationship to the land.</p>
                                <p>And with 430 million people estimated to work directly or indirectly for the fashion and textile industries, improving the supply chains of the fashion industry can mean significant improvements in the lives of many.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- End Shop Blog  -->
@endsection
