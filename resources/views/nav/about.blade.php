@extends('layouts.master')


@section('content')
	<br />
    <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>About IITCEBU</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
                    <p>We are a private Technical-Vocational Education and Training Center located at the A & J Building, A.C. Cortes Avenue, Mandaue City, Cebu, Philippines. We offer 2-year Associate courses and short-term programs.</p>
                </div>
                <div class="col-lg-4">
                    <p>We are registered under the Securities & Exchange Commission (SEC) under registration No.CS201533190.</p>
                </div>
                
            </div>
        </div>
    </section>

    <!-- Portfolio Grid Section -->
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Our Industry Partners</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2 portfolio-item">
                    <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="{{ asset('public/templates/template-1/img/industry-partners/careerfirst_1.jpg') }} " class="img-responsive" alt="Cookery NC-II">
                    </a>
                </div>
                <div class="col-sm-2 portfolio-item">
                    <a href="#portfolioModal2" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="{{ asset('public/templates/template-1/img/industry-partners/copenhagen.png') }}" class="img-responsive" alt="Reporting and Discussion">
                    </a>
                </div>
                <div class="col-sm-2 portfolio-item">
                    <a href="#portfolioModal3" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="{{ asset('public/templates/template-1/img/industry-partners/digitalia.png') }}" class="img-responsive" alt="Air-conditioned Classrooms">
                    </a>
                </div>
                <div class="col-sm-2 portfolio-item">
                    <a href="#portfolioModal4" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="{{ asset('public/templates/template-1/img/industry-partners/fg-solutions.png') }}" class="img-responsive" alt="Career Expo">
                    </a>
                </div>
                <div class="col-sm-2 portfolio-item">
                    <a href="#portfolioModal5" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="{{ asset('public/templates/template-1/img/industry-partners/fil-global.png') }}" class="img-responsive" alt="Awardings">
                    </a>
                </div>

                <div class="col-sm-2 portfolio-item">
                    <a href="#portfolioModal6" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="{{ asset('public/templates/template-1/img/industry-partners/mitsubishi.png') }}" class="img-responsive" alt="Awardings">
                    </a>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-2 portfolio-item">
                    <a href="#portfolioModal7" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="{{ asset('public/templates/template-1/img/industry-partners/papakits.png') }}" class="img-responsive" alt="Awardings">
                    </a>
                </div>
                <div class="col-sm-2 portfolio-item">
                    <a href="#portfolioModal8" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="{{ asset('public/templates/template-1/img/industry-partners/prince.png') }}" class="img-responsive" alt="Awardings">
                    </a>
                </div>
                <div class="col-sm-2 portfolio-item">
                    <a href="#portfolioModal9" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="{{ asset('public/templates/template-1/img/industry-partners/shemberg.png') }}" class="img-responsive" alt="Awardings">
                    </a>
                </div>
                <div class="col-sm-2 portfolio-item">
                    <a href="#portfolioModal10" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="{{ asset('public/templates/template-1/img/industry-partners/teleperformance.png') }}" class="img-responsive" alt="Awardings">
                    </a>
                </div>
                <div class="col-sm-2 portfolio-item">
                    <a href="#portfolioModal11" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="{{ asset('public/templates/template-1/img/industry-partners/thinking_tools_1.jpg') }}" class="img-responsive" alt="Awardings">
                    </a>
                </div>
               
            </div>
        </div>
    </section>

<div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Career First Institute</h2>
                            <hr class="star-primary">
                            <img src="{{ asset('public/templates/template-1/img/industry-partners/careerfirst_1.jpg') }}" class="img-responsive img-centered" alt="">
                            <p><a href="http://www.careerfirstinstitute.com/">Career First Institute</a> was established in 2011 to meet the growing demand for qualified professionals in in the BPO, offshoring industry. They are licensed by the Department of Labor and Employment as a Private Recruitment and Placement Agency (PRPA). <br />They embody a forward-thinking disposition that reflects the dynamism, excitement, passion of today’s modern professionals and businesses. We are an architect of opportunities that connect the potentials of individuals to the ambitions of global businesses.</p>

                            
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>

 <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Copenhagen Resident</h2>
                            <hr class="star-primary">
                            <img src="{{ asset('public/templates/template-1/img/industry-partners/copenhagen.png') }}" class="img-responsive img-centered" alt="">
                            <p>The <a href="http://copenhagen.ph">Copenhagen</a>   Building in Cebu hosts Copenhagen Residences. The city’s best solution for affordable short term or long term accommodation needs. You can stay either in the new Copenhagen main Building with all hotel amenities or if you are travelling on a budget you can stay at Copenhagen East in close proximity to the main building. <br />The interiors were designed by local interior designer Ms. Louise Crisostomo specifically for the Copenhagen Residences. It is one of the finest modern buildings in the greater Cebu area and features all hotel services. It was commissioned by the Ironwood Property Ventures Corporation, a Filipino  company.</p>

                            
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>

	<div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
	        <div class="modal-content">
	            <div class="close-modal" data-dismiss="modal">
	                <div class="lr">
	                    <div class="rl">
	                    </div>
	                </div>
	            </div>
	            <div class="container">
	                <div class="row">
	                    <div class="col-lg-8 col-lg-offset-2">
	                        <div class="modal-body">
	                            <h2>Digitalia Internet Marketing</h2>
	                            <hr class="star-primary">
	                            <img src="{{ asset('public/templates/template-1/img/industry-partners/digitalia.png') }}" class="img-responsive img-centered" alt="">
	                            <p><strong>Digitalia Internet Marketing </strong> Services is a growing BPO company based in Cebu city. They offer IT services worldwide: software development and digital marketing services. Our bigger client is a Silicon Valley law firm. <br />
 
								The company is now offering an excellent opportunity for those who are willing to take the initiative to help make the company a success.</p>

	                            
	                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	   </div>

	   <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
	        <div class="modal-content">
	            <div class="close-modal" data-dismiss="modal">
	                <div class="lr">
	                    <div class="rl">
	                    </div>
	                </div>
	            </div>
	            <div class="container">
	                <div class="row">
	                    <div class="col-lg-8 col-lg-offset-2">
	                        <div class="modal-body">
	                            <h2>FG Solutions Ltd</h2>
	                            <hr class="star-primary">
	                            <img src="{{ asset('public/templates/template-1/img/industry-partners/fg-solutions.png') }}" class="img-responsive img-centered" alt="">
	                            <p><a href="http://www.fgsolutions.co.uk/">FG Solutions Ltd</a>  is a UK- based business consulting company that offers top of the line recruitment, immigration/legal, and business consultancy services to individuals, families and employers across the world.</p>

	                            
	                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	   </div>

	   <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
	        <div class="modal-content">
	            <div class="close-modal" data-dismiss="modal">
	                <div class="lr">
	                    <div class="rl">
	                    </div>
	                </div>
	            </div>
	            <div class="container">
	                <div class="row">
	                    <div class="col-lg-8 col-lg-offset-2">
	                        <div class="modal-body">
	                            <h2>Fil Global Ltd</h2>
	                            <hr class="star-primary">
	                            <img src="{{ asset('public/templates/template-1/img/industry-partners/fil-global.png') }}" class="img-responsive img-centered" alt="">
	                            <p><a href="https://studyworkliveabroad.com/">Fil Global Ltd</a>  processes and provides Student Visa services to our clients who are interested to successfully establish a career in Business, Sales, Marketing, and Tourism in Canada, Australia, New Zealand, Scotland, Wales, Republic of Ireland and most popularly in United Kingdom. We can also provide University Student Placements for those who don’t have a sponsorship or Certificate of Acceptance of Studies. world.</p>

	                            
	                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	   </div>

	   <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
	        <div class="modal-content">
	            <div class="close-modal" data-dismiss="modal">
	                <div class="lr">
	                    <div class="rl">
	                    </div>
	                </div>
	            </div>
	            <div class="container">
	                <div class="row">
	                    <div class="col-lg-8 col-lg-offset-2">
	                        <div class="modal-body">
	                            <h2>Mitsubishi Motors</h2>
	                            <hr class="star-primary">
	                            <img src="{{ asset('public/templates/template-1/img/industry-partners/mitsubishi.png') }}" class="img-responsive img-centered" alt="">
	                            <p><a href="http://mmpc.ph">Mitsubishi Motors</a> - With a new line-up that boasts of technological advancements and a new plant to call home in Santa Rosa, Laguna, Mitsubishi Motors Philippines Corporation seizes the day and welcomes every opportunity with a mindset that speaks of the company’s commitment to excellence, sustainability, the environment and drive for innovation. The future has never looked this bright.</p>

	                            
	                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	   </div>
	   <div class="portfolio-modal modal fade" id="portfolioModal7" tabindex="-1" role="dialog" aria-hidden="true">
	        <div class="modal-content">
	            <div class="close-modal" data-dismiss="modal">
	                <div class="lr">
	                    <div class="rl">
	                    </div>
	                </div>
	            </div>
	            <div class="container">
	                <div class="row">
	                    <div class="col-lg-8 col-lg-offset-2">
	                        <div class="modal-body">
	                            <h2>Papakits</h2>
	                            <hr class="star-primary">
	                            <img src="{{ asset('public/templates/template-1/img/industry-partners/papakits.png') }}" class="img-responsive img-centered" alt="">
	                            <p><a href="http://papakitsmarina.com">Papakits</a> - Celebrate life’s most important events with friends & family at our resort’s Clubhouse. Conduct corporate meetings, weddings, birthdays & even team buildings with ease and convenience as you enjoy the excellent service of our resort. Find yourself dining in our restaurants and see a panoramic view of the bay at night.</p>

	                            
	                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	   </div>
	   <div class="portfolio-modal modal fade" id="portfolioModal8" tabindex="-1" role="dialog" aria-hidden="true">
	        <div class="modal-content">
	            <div class="close-modal" data-dismiss="modal">
	                <div class="lr">
	                    <div class="rl">
	                    </div>
	                </div>
	            </div>
	            <div class="container">
	                <div class="row">
	                    <div class="col-lg-8 col-lg-offset-2">
	                        <div class="modal-body">
	                            <h2>Prince Warehouse Club</h2>
	                            <hr class="star-primary">
	                            <img src="{{ asset('public/templates/template-1/img/industry-partners/prince.png') }}" class="img-responsive img-centered" alt="">
	                            <p><a href="http://www.princeretail.com">Prince Warehouse Club</a> - We serve the base of the pyramid of the Philippine market, which comprises of more than 85% of the population. These underserved communities are the people who need our products and service the most. We offer to them the right products at affordable prices in a convenient and lively shopping experience. Known for our low prices and personalized customer service, we make an impact in the lives of every Filipino in every town in every Vis-Min region.</p>

	                            
	                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	   </div>
	   <div class="portfolio-modal modal fade" id="portfolioModal9" tabindex="-1" role="dialog" aria-hidden="true">
	        <div class="modal-content">
	            <div class="close-modal" data-dismiss="modal">
	                <div class="lr">
	                    <div class="rl">
	                    </div>
	                </div>
	            </div>
	            <div class="container">
	                <div class="row">
	                    <div class="col-lg-8 col-lg-offset-2">
	                        <div class="modal-body">
	                            <h2>Shemberg Corporation</h2>
	                            <hr class="star-primary">
	                            <img src="{{ asset('public/templates/template-1/img/industry-partners/shemberg.png') }}" class="img-responsive img-centered" alt="">
	                            <p>Shemberg Mktg. Corp. - SW Division is a leading exporter and manufacturer of carrageenan, an essential ingredient in the food and non-food industry as a binding, thickening, emulsifying and stabilizing agent. Carrageenan is derived from red seaweeds.</p>

	                            
	                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	   </div>
	   <div class="portfolio-modal modal fade" id="portfolioModal10" tabindex="-1" role="dialog" aria-hidden="true">
	        <div class="modal-content">
	            <div class="close-modal" data-dismiss="modal">
	                <div class="lr">
	                    <div class="rl">
	                    </div>
	                </div>
	            </div>
	            <div class="container">
	                <div class="row">
	                    <div class="col-lg-8 col-lg-offset-2">
	                        <div class="modal-body">
	                            <h2>Teleperformance</h2>
	                            <hr class="star-primary">
	                            <img src="{{ asset('public/templates/template-1/img/industry-partners/teleperformance.png') }}" class="img-responsive img-centered" alt="">
	                            <p><a href="https://www.teleperformance.com/en-us/">Teleperformance</a> - We are the worldwide leader in outsourced omnichannel customer experience management. Teleperformance  connects  the biggest and most respected brands on the planet with their customers by providing  customer care, technical support, customer acquisition, digital solutions, analytics, back-office and other specialized services to ensure consistently positive customer interactions. When your customers contact you or vice versa, we are there to support them and make sure they have a unique experience with your brand in all channels..</p>

	                            
	                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	   </div>
	   <div class="portfolio-modal modal fade" id="portfolioModal11" tabindex="-1" role="dialog" aria-hidden="true">
	        <div class="modal-content">
	            <div class="close-modal" data-dismiss="modal">
	                <div class="lr">
	                    <div class="rl">
	                    </div>
	                </div>
	            </div>
	            <div class="container">
	                <div class="row">
	                    <div class="col-lg-8 col-lg-offset-2">
	                        <div class="modal-body">
	                            <h2>Teleperformance</h2>
	                            <hr class="star-primary">
	                            <img src="{{ asset('public/templates/template-1/img/industry-partners/thinking_tools_1.jpg') }}" class="img-responsive img-centered" alt="">
	                            <p><a href="https://www.tti.com.ph/">Thinking Tools</a> - With the primary goal of providing the growing computer marketbase in Cebu City with better computer products and services, Thinking Tools, Inc. was conceptualized and incorporated in April 1987, then opened its 1st computer shop in June 1987.</p>

	                            
	                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	   </div>
@endsection