
@php
    $company = \App\Helpers\Global_helper::companyDetails();
    $get_service = \App\Helpers\Global_helper::getServiceHelper();

@endphp
<!DOCTYPE html>
<html lang="en">
   <head>
      <!--website title-->
      <title>{{ @$company->name }}</title>
      <style>
          .achievements-metrics {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
}
.metric {
  flex: 1 1 45%;
  text-align: center;
  padding: 20px;
  background: #f9f9f9;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.metric strong {
  display: block;
  font-size: 2em;
  color: #333;
}
.metric span {
  display: block;
  font-size: 1em;
  color: #666;
}
em{
    color:#4b0082 !important;
}

      </style>
      <!--seo-meta-tag-->
      <meta charset="UTF-8">
      <meta name="description" content="Loans Agency HTML Landing Page Template">
      <meta name="keywords" content="Loans Agency HTML Landing Page Template">
      <meta name="author" content="rajesh-doot">
       <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!--website-favicon-->
      @if(@$company->favicon)
      <link rel="icon" type="image/png" href="{{ asset('storage/'.$company->favicon) }}">
      @endif
      <!--plugin-scripts-->
      <link rel="stylesheet" href="{{ asset('website_assets/css/bootstrap.min.css') }}">
      <link rel="stylesheet" href="{{ asset('website_assets/css/owl.carousel.min.css') }}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
      <link href="{{ asset('website_assets/css/aos.css') }}" rel="stylesheet">
      <!--google-fonts-->
      <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet">
      <!-- template-style-->
      <link rel="stylesheet" type="text/css" href="{{ asset('website_assets/css/style.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('website_assets/css/responsive.css') }}">
   </head>
   <body data-spy="scroll" data-target=".navbar" data-offset="100" class="ct1280">
      <!--Start Header -->
      <header class="top-header th2">
         <nav class="navbar navbar-expand-lg justify-content-between navbar-mobile fixed-top">
            <div class="container">
                <div class="d-flex justify-content-between w-100 align-items-center">
                    <div class="lefthdr">
                       <a class="navbar-brand" href="./">
                          @if(@$company->logo)
              <img src="{{ asset('storage/'.$company->logo) }}" alt="Logo" class="white-logo">
              <img src="{{ asset('storage/'.$company->logo) }}" alt="Logo" class="dark-logo">
              @endif
                       </a>
                    </div>
                    <div class="righthdr">
                       <div class="hide-desk">
                          <a class="mobile-btn btn-call" href="tel:123-456-7890"><i class="fas fa-phone-alt"></i> <span><span class="clltxt"></a>
                          <a class="mobile-btn btn-call getmob" href="#" data-toggle="modal" data-target="#modal_aside_right"> Get Quote</a>
                           <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbar4" aria-controls="navbar4" aria-expanded="false" aria-label="Toggle navigation">
                           <span class="icon-bar top-bar"></span>
                           <span class="icon-bar middle-bar"></span>
                           <span class="icon-bar bottom-bar"></span>
                           </button>
                       </div>
                    </div>
               </div>
               <div class="collapse navbar-collapse" id="navbar4">
                          <ul class="mr-auto"></ul>
                          <ul class="navbar-nav v-center">
                             <li class="nav-item"> <a class="nav-link" href="#home">Home</a></li>
                             <li class="nav-item"> <a class="nav-link" href="#about">About </a></li>
                             <li class="nav-item"> <a class="nav-link" href="#partners">Partners</a></li>
                             <li class="nav-item"> <a class="nav-link" href="#review">Reviews</a></li>
                             <li class="nav-item"> <a class="nav-link" href="#modal" data-toggle="modal" data-target="#modal_aside_right">Contact Us</a></li>
                             <li class="nav-item"> <a class="nav-link" href="{{ route('login') }}">Login</a></li>

                             <li class="nav-item"> <a class="nav-link btn-call hide-mob" href="https://wa.me/{{ $company->mobile }}?text=Hello%20there!%20I%20would%20like%20to%20inquire%20about%20your%20services." target="_blank">
                                <i class="fas fa-phone-alt"></i>
                                <span><span class="clltxt">Happy to Help you</span>
                                +91 {{ $company->mobile }} </span>                     </a>

                          </li>
                          </ul>
                    </div>
            </div>

         </nav>
      </header>
      <!--End Header -->
      <!--Start Hero-->
      <section class="hero-section-1  agency-bg" id="home">
         <div class="blur-bg-blocks">
            <aside class="blur-bg-set">
               <div class="blur-bg blur-bg-a"></div>
               <div class="blur-bg blur-bg-b"></div>
               <div class="blur-bg blur-bg-c"></div>
            </aside>
         </div>
         <div class="container">
            <div class="row justify-content-between">
               <div class="col-lg-5 v-center">
                  <div class="header-heading-1">
                      <br>
                     <h1 class="mb30" data-aos="zoom-out-up" style="color:#4b0082;">We are Loanswala </h1><span class="fw3" style="font-size:26px;">India’s Largest Loan Distributor Platform.</span> <br><br>
                     <p  data-aos="zoom-out-up" data-aos-delay="400">Join us as a Financial Advisor. Be a part of a large and growing family of 5,000+ partners.</p>
                     <a href="#modal" data-toggle="modal" data-target="#modal_aside_right" class="btnpora btn-rd2 mt30" data-aos="zoom-out-up" data-aos-delay="600">Get your Quote</a>
                  </div>
                  <!--<div class="hero-feature" data-aos="zoom-out-up" data-aos-delay="800">-->
                  <!--   <div class="media v-center" >-->
                  <!--      <div class="icon-pora"><img src="website_assets/images/icons/fast-time.png" alt="icon" class="w-100"></div>-->
                  <!--      <div class="media-body">Quick, Easy &	Hassle Free</div>-->
                  <!--   </div>-->
                  <!--   <div class="media v-center">-->
                  <!--      <div class="icon-pora"><img src="website_assets/images/icons/customer-services.png" alt="icon" class="w-100"></div>-->
                  <!--      <div class="media-body">100% Claims Support</div>-->
                  <!--   </div>-->
                  <!--</div>-->
               </div>
               <div class="col-lg-5">
                  <div class="img-box m-mt60 text-center" data-aos="fade-In" data-aos-delay="400" data-aos-duration="3000"><img src="website_assets/images/hero/beautiful-curly-girl.png" alt="car" class="img-fluid">
                  </div>
               </div>
               </div>

               <div class="row">
                  <div class="col-12">
                     <div class="service-card">
                         <div class="servicecard up-hor">
                           <a href="#">
                              <img src="website_assets/images/icons/homeloan.png" alt="icon">
                              <p>Home<br> Loan </p>
                           </a>
                        </div>
                          <div class="servicecard up-hor">
                           <a href="#">
                              <img src="website_assets/images/icons/loan_against_property.jpg" alt="icon">
                              <p>Loan against Property<br> </p>
                           </a>
                        </div>
                        <div class="servicecard up-hor">
                           <a href="#">
                              <img src="website_assets/images/icons/personal.jpg" alt="icon">
                              <p>Personal Loan<br></p>
                           </a>
                        </div>
                        <div class="servicecard up-hor">
                           <a href="#">
                              <img src="website_assets/images/icons/business.webp" alt="icon">
                              <p>Business Loan<br></p>
                           </a>
                        </div>
                           <div class="servicecard up-hor">
                           <a href="#">
                              <img src="website_assets/images/icons/car.png" alt="icon">
                              <p>Car<br> Loan</p>
                           </a>
                        </div>
                        <div class="servicecard up-hor">
                           <a href="#">
                              <img src="website_assets/images/icons/car.png" alt="icon">
                              <p>Commercial Vehicle Loan<br> </p>
                           </a>
                        </div>
                         <div class="servicecard up-hor">
                           <a href="#">
                              <img src="website_assets/images/icons/building.png" alt="icon">
                              <p>Industrial<br> Loan </p>
                           </a>
                        </div>
                        <!--<div class="servicecard up-hor">-->
                        <!--   <a href="#">-->
                        <!--      <img src="website_assets/images/icons/heart.png" alt="icon">-->
                        <!--      <p>Health<br></p>-->
                        <!--   </a>-->
                        <!--</div>-->
                        <!--<div class="servicecard up-hor">-->
                        <!--   <a href="#">-->
                        <!--      <img src="website_assets/images/icons/team.png" alt="icon">-->
                        <!--      <p>Group Health<br></p>-->
                        <!--   </a>-->
                        <!--</div>-->
                        <div class="servicecard up-hor">
                           <a href="#">
                              <img src="website_assets/images/icons/credit.png" alt="icon">
                              <p>Credit Cards<br></p>
                           </a>
                        </div>
                        <!--<div class="servicecard up-hor">-->
                        <!--   <a href="#">-->
                        <!--      <img src="website_assets/images/icons/health-care.png" alt="icon">-->
                        <!--      <p>Life<br> </p>-->
                        <!--   </a>-->
                        <!--</div>-->
                        <div class="servicecard up-hor">
                           <a href="#">
                              <img src="website_assets/images/icons/education.jpg" alt="icon">
                              <p>Education<br> Plans</p>
                           </a>
                        </div>
                        <!--<div class="servicecard up-hor">-->
                        <!--   <a href="#">-->
                        <!--      <img src="website_assets/images/icons/baby-boy.png" alt="icon">-->
                        <!--      <p>Child Savings<br> Plans</p>-->
                        <!--   </a>-->
                        <!--</div>-->
                        <!--<div class="servicecard up-hor">-->
                        <!--   <a href="#">-->
                        <!--      <img src="website_assets/images/icons/bycicle.png" alt="icon">-->
                        <!--      <p>2 Wheeler<br> Loan</p>-->
                        <!--   </a>-->
                        <!--</div>-->


                        <div class="servicecard up-hor">
                           <a href="#">
                              <img src="website_assets/images/icons/piggy-bank.png" alt="icon">
                              <p>Gold<br> Loan</p>
                           </a>
                        </div>
                        <div class="servicecard up-hor">
                           <a href="#">
                              <img src="website_assets/images/icons/overdraft.png" alt="icon">
                              <p>Overdraft Limit</p>
                           </a>
                        </div>
                        <div class="servicecard up-hor">
                           <a href="#">
                              <img src="website_assets/images/icons/consu.png" alt="icon">
                              <p>Consumer Durable<br> Loan</p>
                           </a>
                        </div>

                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!--End Hero-->
      <!--why us start-->
      <!--<div class="enquire-form pad-tb pora-bg1 text-white" id="contact">-->
      <!--   <div class="container">-->
      <!--      <div class="row">-->
      <!--         <div class="col-lg-12">-->
      <!--            <div class="cta-heading text-center">-->
      <!--               <span class="subhead" data-aos="fade-up" data-aos-delay="100">Why Choose Pora</span>-->
      <!--               <h3 data-aos="fade-up" data-aos-delay="300">Live Your Best Life Today, Your Tomorrow Is Secured With Us</h3>-->
      <!--            </div>-->
      <!--            <div class="whyus mt60">-->
      <!--               <div class="whyusbox" data-aos="fade-In" data-aos-delay="100">-->
      <!--                  <div class="imgbdr shadows"> <img src="website_assets/images/icons/student.png" alt="icon"> </div>-->
      <!--                  <p>Child's Education</p>-->
      <!--               </div>-->
      <!--               <div class="whyusbox" data-aos="fade-In" data-aos-delay="200">-->
      <!--                  <div class="imgbdr shadows"> <img src="website_assets/images/icons/oldman.png" alt="icon"> </div>-->
      <!--                  <p>Care-free Retirement</p>-->
      <!--               </div>-->
      <!--               <div class="whyusbox" data-aos="fade-In" data-aos-delay="300">-->
      <!--                  <div class="imgbdr shadows"> <img src="website_assets/images/icons/security.png" alt="icon"> </div>-->
      <!--                  <p>Financial Security</p>-->
      <!--               </div>-->
      <!--               <div class="whyusbox" data-aos="fade-In" data-aos-delay="400">-->
      <!--                  <div class="imgbdr shadows"> <img src="website_assets/images/icons/insurance.png" alt="icon"> </div>-->
      <!--                  <p>Family’s Protection</p>-->
      <!--               </div>-->
      <!--               <div class="whyusbox" data-aos="fade-In" data-aos-delay="500">-->
      <!--                  <div class="imgbdr shadows"> <img src="website_assets/images/icons/wealth.png" alt="icon"> </div>-->
      <!--                  <p>Wealth Creation</p>-->
      <!--               </div>-->
      <!--            </div>-->
      <!--         </div>-->
      <!--      </div>-->
      <!--   </div>-->
      <!--</div>-->
      <!--End why us-->
      <!--Start about-->
      <section class="about-bg-2 pad-tb" id="about">
         <div class="container">
            <div class="row m-text-c">
               <div class="col-lg-6 v-center">
                        <h2 class="mb20" data-aos="fade-up" data-aos-delay="100"> <em >About Us</em></h2>
                  <div class="about-company">
                     {{-- <h2 class="mb20" data-aos="fade-up" data-aos-delay="100">Save <em>Upto 90%</em> with Best <span class="fw3">Loans Plans offered by insurers</span></h2> --}}
                     <h2 class="mb20" data-aos="fade-up" data-aos-delay="100">Earn <em>up to 100%</em> <span class="fw3">of the payout that is given to us by the lending partner.</span></h2>
                     {{-- Earn up to 100% of the payout that is given to us by the lending partner. --}}
                     <p data-aos="fade-up" data-aos-delay="300">We started with the aim of making the complete loan process as easy as possible so that every individual can have access to take loan easily. Loanswala is one of the major digital lending platforms in the country which uses technology and analytics tools for analyzing and processing customers loan application so that we can help our customers to get money with minimum documents in their account in as less as 48 hours.</p>
                     <br>
                     <p data-aos="fade-up" data-aos-delay="300">We believe the way we have used our technology will help everyone to meet their financial requirement in just one click. Being a Fintech company we have provided a single platform where the customer will get access to all kind of loan products i.e Personal Loan, Business Loan, Home Loan, Mortgage Loan.</p>
                     <a href="#" class="btnpora btn-rd2 mt40" data-aos="fade-up" data-aos-delay="600" data-toggle="modal" data-target="#modal_aside_right">Get your Quote</a>
                  </div>
               </div>
               <div class="col-lg-6 v-center">
                  <div class="img-box1 m-mt60" data-aos="fade-up" data-aos-delay="500"><img src="website_assets/images/common/agent.png" alt="feature-image" class="img-fluid"></div>
               </div>
            </div>
         </div>
      </section>
      <!--End about -->
      <!--Start partner-->
      <section class="about-bg pad-tb" id="partners">
         <div class="container">
            <div class="row justify-content-between">
               <div class="col-lg-6 v-center">
                  <div class="partner-company">
                     <h2 class="mb20" data-aos="fade-up" data-aos-delay="100"> <em >Our Partners</em></h2>
                     <p data-aos="fade-up" data-aos-delay="100">We are collaborate with the best and biggest lending partner in the banking & financial Industry. Our Partner are our strength.</p>
                  </div>
                  <div class="partnerlogo mt40"  data-aos="fade-In" data-aos-delay="500">
                     <a href="#"><img src="website_assets/images/partner/aditya.png" alt="brand logo"> </a>
                     <a href="#"><img src="website_assets/images/partner/au.png" alt="brand logo"> </a>
                     <a href="#"><img src="website_assets/images/partner/awas.png" alt="brand logo"> </a>
                     <a href="#"><img src="website_assets/images/partner/bajaj.jpg" alt="brand logo"> </a>
                     <a href="#"><img src="website_assets/images/partner/capri.jpg" alt="brand logo dfdfdf"> </a>
                     <a href="#"><img src="website_assets/images/partner/hindu.jpg" alt="brand logo"> </a>
                     <a href="#"><img src="website_assets/images/partner/idfc.avif" alt="brand logo"> </a>
                     <a href="#"><img src="website_assets/images/partner/indiabulls.png" alt="brand logo"> </a>
                     <a href="#"><img src="website_assets/images/partner/jm.jpeg" alt="brand logo"> </a>
                     <a href="#"><img src="website_assets/images/partner/kotak.png" alt="brand logo"> </a>
                     <a href="#"><img src="website_assets/images/partner/lic.png" alt="brand logo"> </a>
                     <a href="#"><img src="website_assets/images/partner/mahindra.jpg" alt="brand logo"> </a>
                     <a href="#"><img src="website_assets/images/partner/pirmal.png" alt="brand logo"> </a>
                     <a href="#"><img src="website_assets/images/partner/poonawala.png" alt="brand logo"> </a>
                     <a href="#"><img src="website_assets/images/partner/sbm.png" alt="brand logo"> </a>
                     <a href="#"><img src="website_assets/images/partner/sfmg.png" alt="brand logo"> </a>
                     <a href="#"><img src="website_assets/images/partner/tata_capital.jpg" alt="brand logo"> </a>
                     <a href="#"><img src="website_assets/images/partner/ugro.jpg" alt="brand logo"> </a>
                     <a href="#"><img src="website_assets/images/partner/vastu.png" alt="brand logo"> </a>
                     <a href="#"><img src="website_assets/images/partner/yes.jpg" alt="brand logo"> </a>
                  </div>
               </div>
               <div class="col-lg-5 v-center">
                  <div class="img-box1 m-mt60"  data-aos="fade-In" data-aos-delay="100"><img src="website_assets/images/common/parntership.png" alt="image" class="img-fluid"></div>
               </div>
            </div>
         </div>
      </section>
      <!--End partner -->

      <!--Start Loan Steps-->
      <section class="step-bg pt50 pb80">
         <div class="container">
            <div class="row">
               <div class="col-lg-12 v-center">
                  <div class="common-heading m-text-c pr50">
                     <h2 class="mb20 text-center" data-aos="fade-up" data-aos-delay="100"><em>Advantage Of Loanswala</em></h2>
                     <!--<p data-aos="fade-up" data-aos-delay="100">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>-->
                  </div>
               </div>
               <div class="col-lg-12 v-center m-mt60">
                  <div class="row divrightbdr">
                     <div class="col-lg-6">
                        <div class="steps-div  mt30" data-aos="fade-up" data-aos-delay="100">
                           <div class="steps-icons-1">	<img src="website_assets/images/icons/choice.png" alt="steps"> </div>
                           <h4 class="mb10">India’s Leading Loan Distributor</h4>
                           <p>Unlock your financial dreams with India’s leading loan distributor. Offering quick approvals and customized solutions to meet all your loan needs.</p>
                        </div>
                        <div class="steps-div mt30" data-aos="fade-up" data-aos-delay="300">
                           <div class="steps-icons-1">	<img src="website_assets/images/icons/credit-card.png" alt="steps"> </div>
                           <h4 class="mb10">Pan India Presence</h4>
                           <p>Empowering dreams with a strong Pan-India presence. Access our trusted loan services anytime, anywhere across the nation.</p>
                        </div>
                        <div class="steps-div mt30" data-aos="fade-up" data-aos-delay="300">
                           <div class="steps-icons-1">	<img src="website_assets/images/icons/credit-card.png" alt="steps"> </div>
                           <h4 class="mb10">Multiple Product</h4>
                           <p>Explore a diverse range of loan products tailored to your needs. From personal loans to business financing, we’ve got you covered.</p>
                        </div>
                     </div>
                     <div class="col-lg-6 mt60 m-m0">
                        <div class="steps-div mt30" data-aos="fade-up" data-aos-delay="200">
                           <div class="steps-icons-1">	<img src="website_assets/images/icons/easy.png" alt="steps"> </div>
                           <h4 class="mb10">Easy Onboarding Process</h4>
                           <p>Experience a seamless and hassle-free onboarding process. Get started quickly with minimal documentation and expert support.</p>
                        </div>
                        <div class="steps-div mt30" data-aos="fade-up" data-aos-delay="500">
                           <div class="steps-icons-1">	<img src="website_assets/images/icons/customers.png" alt="steps"> </div>
                           <h4 class="mb10">Rejection Ratio Zero</h4>
                           <p>Achieve your financial goals with confidence—our rejection ratio is zero. We ensure every application gets the attention it deserves.</p>
                        </div>
                        <div class="steps-div mt30" data-aos="fade-up" data-aos-delay="500">
                           <div class="steps-icons-1">	<img src="website_assets/images/icons/customers.png" alt="steps"> </div>
                           <h4 class="mb10">100% Transparency in Process</h4>
                           <p>Enjoy 100% transparency at every step of the loan process. No hidden charges, just honest and clear communication.</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!--End Loan Steps-->

      <!--Start CTA-->
      <div class="cta-section pad-tb bg-fixed-img" data-parallax="scroll" data-speed="0.5" data-image-src="website_assets/images/common/wideimg.png">
         <div class="container">
            <div class="row justify-content-center text-center">
               <div class="col-lg-8">
                  <div class="cta-heading">
                     <h2 class="mb20 text-w"  data-aos="fade-up" data-aos-delay="100">Request a Free Consultation!</h2>
                     <p class="text-w"  data-aos="fade-up" data-aos-delay="300">Take the first step towards your financial goals today! Request a free consultation and get expert advice tailored to your needs.</p>
                     <a href="#modal" data-toggle="modal" data-target="#modal_aside_right" class="btnpora btn-rd3 mt40 noshadow"  data-aos="fade-up" data-aos-delay="500"> Get your Quote</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
     <section class="about-bg pad-tb" id="achievements">
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-lg-6 v-center">
        <div class="achievements-content">
          <h2 class="mb20" data-aos="fade-up" data-aos-delay="100">
             <em> Our Achievements</em>
          </h2>
          <p data-aos="fade-up" data-aos-delay="100">
            We are proud of our extensive reach and significant impact in the industry. Our journey has been built on trust, expertise, and unmatched service quality.
          </p>
        </div>
        <div class="achievements-metrics mt40" data-aos="fade-in" data-aos-delay="500">
          <div class="metric">
            <strong>50+</strong>
            <span>Cities</span>
          </div>
          <div class="metric">
            <strong>100+</strong>
            <span>Branches</span>
          </div>
          <div class="metric">
            <strong>250+</strong>
            <span>Financial Advisors</span>
          </div>
          <div class="metric">
            <strong>75+</strong>
            <span>Lending Partner Banks & NBFCs</span>
          </div>
          <div class="metric">
            <strong>500++</strong>
            <span>Employees</span>
          </div>
          <div class="metric">
            <strong>500 Cr ++</strong>
            <span>Successful Disbursed Amount</span>
          </div>
          <div class="metric">
            <strong>10,000++</strong>
            <span>Happy Customers</span>
          </div>
          <div class="metric">
               <strong>10+</strong>
            <strong>Years of Experience</strong>
            <span>In Service</span>
          </div>
        </div>
      </div>
      <div class="col-lg-5 v-center">
        <div class="img-box1 m-mt60" data-aos="fade-in" data-aos-delay="100">
          <img src="website_assets/images/ach.webp" alt="Achievements" class="img-fluid">
        </div>
      </div>
    </div>
  </div>
</section>

      <!--End CTA-->
      <!--Start Agent-->
      <!--<section class="agent-section pad-tb" id="agent">-->
      <!--   <div class="container">-->
      <!--      <div class="row justify-content-center text-center">-->
      <!--         <div class="col-lg-6">-->
      <!--            <div class="common-heading">-->
      <!--               <h2 class="mb20" data-aos="fade-up" data-aos-delay="100">Meet The <em>Agents</em></h2>-->
      <!--               <p data-aos="fade-up" data-aos-delay="300">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>-->
      <!--            </div>-->
      <!--         </div>-->
      <!--      </div>-->
      <!--      <div class="row mt30">-->
      <!--         <div class="col-lg-3 col-6 mt30"  data-aos="fade-In" data-aos-delay="100">-->
      <!--            <div class="full-image-card hover-scale">-->
      <!--               <div class="image-div"><a href="#"><img src="website_assets/images/agents/team-1.jpg" alt="team" class="img-fluid"></a></div>-->
      <!--               <div class="info-text-block">-->
      <!--                  <h5><a href="#">Shakita Daoust</a></h5>-->
      <!--                  <p>Loans Agent</p>-->
      <!--                  <div class="social-links-">-->
      <!--                     <a href="#" target="blank"><i class="fab fa-facebook-f"></i> </a>-->
      <!--                     <a href="#" target="blank"><i class="fab fa-twitter"></i> </a>-->
      <!--                     <a href="#" target="blank"><i class="fab fa-linkedin-in"></i> </a>-->
      <!--                  </div>-->
      <!--               </div>-->
      <!--            </div>-->
      <!--         </div>-->
      <!--         <div class="col-lg-3 col-6 mt30"  data-aos="fade-In" data-aos-delay="300">-->
      <!--            <div class="full-image-card hover-scale">-->
      <!--               <div class="image-div"><a href="#"><img src="website_assets/images/agents/team-2.jpg" alt="team" class="img-fluid"></a></div>-->
      <!--               <div class="info-text-block">-->
      <!--                  <h5><a href="#">Gerard Licari</a></h5>-->
      <!--                  <p>Loans Agent</p>-->
      <!--                  <div class="social-links-">-->
      <!--                     <a href="#" target="blank"><i class="fab fa-facebook-f"></i> </a>-->
      <!--                     <a href="#" target="blank"><i class="fab fa-twitter"></i> </a>-->
      <!--                     <a href="#" target="blank"><i class="fab fa-linkedin-in"></i> </a>-->
      <!--                  </div>-->
      <!--               </div>-->
      <!--            </div>-->
      <!--         </div>-->
      <!--         <div class="col-lg-3 col-6 mt30"  data-aos="fade-In" data-aos-delay="500">-->
      <!--            <div class="full-image-card hover-scale">-->
      <!--               <div class="image-div"><a href="#"><img src="website_assets/images/agents/team-3.jpg" alt="team" class="img-fluid"></a></div>-->
      <!--               <div class="info-text-block">-->
      <!--                  <h5><a href="#">Cary Montgomery</a></h5>-->
      <!--                  <p>Loans Agent</p>-->
      <!--                  <div class="social-links-">-->
      <!--                     <a href="#" target="blank"><i class="fab fa-facebook-f"></i> </a>-->
      <!--                     <a href="#" target="blank"><i class="fab fa-twitter"></i> </a>-->
      <!--                     <a href="#" target="blank"><i class="fab fa-linkedin-in"></i> </a>-->
      <!--                  </div>-->
      <!--               </div>-->
      <!--            </div>-->
      <!--         </div>-->
      <!--         <div class="col-lg-3 col-6 mt30"  data-aos="fade-In" data-aos-delay="700">-->
      <!--            <div class="full-image-card hover-scale">-->
      <!--               <div class="image-div"><a href="#"><img src="website_assets/images/agents/team-4.jpg" alt="team" class="img-fluid"></a></div>-->
      <!--               <div class="info-text-block">-->
      <!--                  <h5><a href="#">Herman Running</a></h5>-->
      <!--                  <p>Loans Agent</p>-->
      <!--                  <div class="social-links-">-->
      <!--                     <a href="#" target="blank"><i class="fab fa-facebook-f"></i> </a>-->
      <!--                     <a href="#" target="blank"><i class="fab fa-twitter"></i> </a>-->
      <!--                     <a href="#" target="blank"><i class="fab fa-linkedin-in"></i> </a>-->
      <!--                  </div>-->
      <!--               </div>-->
      <!--            </div>-->
      <!--         </div>-->
      <!--      </div>-->
      <!--   </div>-->
      <!--</section>-->
      <!--End Agent-->
      <!--Start Reviews-->
      <section class="reviews-section pad-tb review-bg2" id="review">
         <div class="container">
            <div class="row">
               <div class="col-lg-6">
                  <div class="comon-heading">
                     <h2 class="mb20"> <em>Our Happy Customers</em> </h2>
                     <p>See what our clients have to say about their experience with us.</p>
                     <p>Discover the impact of our services through the voices of those we've helped.</p>
                  </div>
                  <h5 class="mt40">Thousands of honest reviews. Trusted by over 10,000 customers.</h5>
                  <ul class="overallrating mt20">
                     <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
                     <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
                     <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
                     <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
                     <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star-half-alt"></i></a> </li>
                  </ul>
               </div>
               <div class="col-lg-6">
                  <div class="reviews-block owl-carousel m-mt60">
                     <div class="reviews-card">
                        <div class="-client-details-">
                           <div class="-reviewr">
                              <img src="website_assets/images/reviews/review-image-1.jpg" alt="Good Review" class="img-fluid">
                           </div>
                           <div class="reviewer-text">
                              <h5>Ravi Kumar</h5>
                              <p>Working Professional</p>
                              <div class="star-rate">
                                 <ul>
                                    <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
                                    <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
                                    <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
                                    <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
                                    <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star-half-alt"></i></a> </li>
                                    <li> <a href="javascript:void(0)">4.2</a> </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="review-text pb0 pt30">
                           <p>I am extremely satisfied with the services provided by Loanswala.com. The entire home loan process was smooth, transparent, and hassle-free, with excellent customer support throughout. The team was professional, responsive, and helped me secure the loan quickly. I highly recommend Loanswala.com to anyone seeking reliable financial solutions.</p>
                        </div>
                     </div>
                     <div class="reviews-card">
                        <div class="-client-details-">
                           <div class="-reviewr">
                              <img src="website_assets/images/reviews/review-image-2.jpg" alt="Good Review" class="img-fluid">
                           </div>
                           <div class="reviewer-text">
                              <h5>Rohit Chopra</h5>
                              <p>Businessman</p>
                              <div class="star-rate">
                                 <ul>
                                    <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
                                    <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
                                    <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
                                    <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
                                    <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star-half-alt"></i></a> </li>
                                    <li> <a href="javascript:void(0)">4.2</a> </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="review-text pb0 pt30">
                           <p>I am truly impressed with the support provided by Loanswala.com for my business loan. The process was efficient, and the team guided me at every step to ensure a smooth experience. The loan approval was quick, allowing me to focus on growing my business without delays. I highly recommend Loanswala.com for entrepreneurs seeking financial assistance. </p>
                        </div>
                     </div>
                     <div class="reviews-card">
                        <div class="-client-details-">
                           <div class="-reviewr">
                              <img src="website_assets/images/reviews/review-image-3.jpg" alt="Good Review" class="img-fluid">
                           </div>
                           <div class="reviewer-text">
                              <h5>Selina Thomas</h5>
                              <p>Entrepreneur</p>
                              <div class="star-rate">
                                 <ul>
                                    <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
                                    <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
                                    <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
                                    <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star" aria-hidden="true"></i></a> </li>
                                    <li> <a href="javascript:void(0)" class="chked"><i class="fas fa-star-half-alt"></i></a> </li>
                                    <li> <a href="javascript:void(0)">4.2</a> </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="review-text pb0 pt30">
                           <p>My experience with Loanswala.com for my loan application was excellent. The process was quick, straightforward, and the team was very professional and helpful. They provided clear guidance and ensured I received the funds without any hassle. I highly recommend Loanswala.com for anyone in need of reliable loan services.</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!--End Reviews-->
      <!--Start Faqs-->
      <!--<section class="faq-section pad-tb ">-->
      <!--   <div class="container">-->
      <!--      <div class="row justify-content-center text-center">-->
      <!--         <div class="col-lg-8">-->
      <!--            <div class="common-heading">-->
      <!--               <h2  data-aos="fade-up" data-aos-delay="100">Frequently Asked Questions</h2>-->
      <!--            </div>-->
      <!--         </div>-->
      <!--      </div>-->
      <!--      <div class="row justify-content-center mt60">-->
      <!--         <div class="col-lg-8">-->
      <!--            <div id="accordion3" class="accordion">-->
      <!--               <div class="card-2">-->
      <!--                  <div class="card-header" id="acc1">-->
      <!--                     <button class="btn btn-link btn-block text-left acc-icon" type="button" data-toggle="collapse" data-target="#collapse-1" aria-expanded="false" aria-controls="collapse-1">-->
      <!--                     What Is Pora Loans?-->
      <!--                     </button>-->
      <!--                  </div>-->
      <!--                  <div id="collapse-1" class="card-body p0 collapse show" aria-labelledby="acc1" data-parent="#accordion3">-->
      <!--                     <div class="data-reqs">-->
      <!--                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's specimen book. Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>-->
      <!--                     </div>-->
      <!--                  </div>-->
      <!--               </div>-->
      <!--               <div class="card-2 mt10">-->
      <!--                  <div class="card-header" id="acc2">-->
      <!--                     <button class="btn btn-link btn-block text-left acc-icon collapsed" type="button" data-toggle="collapse" data-target="#collapse-2" aria-expanded="false" aria-controls="collapse-2">-->
      <!--                     What kind of Loans policies does Pora Loans offer?-->
      <!--                     </button>-->
      <!--                  </div>-->
      <!--                  <div id="collapse-2" class="card-body p0 collapse" aria-labelledby="acc2" data-parent="#accordion3">-->
      <!--                     <div class="data-reqs">-->
      <!--                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's specimen book. Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>-->
      <!--                     </div>-->
      <!--                  </div>-->
      <!--               </div>-->
      <!--               <div class="card-2 mt10">-->
      <!--                  <div class="card-header" id="acc3">-->
      <!--                     <button class="btn btn-link btn-block text-left acc-icon collapsed" type="button" data-toggle="collapse" data-target="#collapse-3" aria-expanded="false" aria-controls="collapse-3">-->
      <!--                     How long does it take to buy an Loans Policy on Pora Loans?-->
      <!--                     </button>-->
      <!--                  </div>-->
      <!--                  <div id="collapse-3" class="card-body p0 collapse" aria-labelledby="acc3" data-parent="#accordion3">-->
      <!--                     <div class="data-reqs">-->
      <!--                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's specimen book. Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>-->
      <!--                     </div>-->
      <!--                  </div>-->
      <!--               </div>-->
      <!--            </div>-->
      <!--         </div>-->
      <!--      </div>-->
      <!--   </div>-->
      <!--</section>-->
      <!--End Faqs-->
      <!--Start Footer-->
      <footer>
         <div class="container">
            <div class="row">
               <div class="col-lg-4">
                  <div class="footer- mb30" style="margin-top: 15px;">
                     @if(@$company->logo)
                     <a href="javascript:void(0)"><img src="{{ asset('storage/'.$company->logo) }}" alt="logo"></a>
                    @endif
                  </div>
                  <p>{{ @$company->name }} is a smart connector of loan companies, dedicated to saving you money by providing loan options that matter at the right moments.</p>
               </div>
               <div class="col-lg-4 col-md-6">
                  <h4 class="mt30 mb30 text-w">Contact Us</h4>
                  <ul class="footer-address-list">
                     <li><i class="fas fa-map-marker-alt"></i> {{ @$company->address }}</li>
                     <li><i class="fas fa-phone-alt"></i> <a href="tel:+91{{ @$company->mobile }}">+91 {{ @$company->mobile }} </a></li>
                     <li><i class="fas fa-envelope"></i> <a href="mailto:{{ @$company->email }}">{{ @$company->email }}</a></li>
                  </ul>
               </div>
               <div class="col-lg-4 col-md-6">
                  <h4 class="mt30 mb30 text-w">Keep in Touch </h4>
                  <div class="footer-social-media-icons">
                     <a href="{{ @$company->facebook }}" target="blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
                     <a href="{{ @$company->twitter }}" target="blank" class="twitter"><i class="fab fa-twitter"></i></a>
                     <a href="{{ @$company->instagram }}" target="blank" class="instagram"><i class="fab fa-instagram"></i></a>
                     <a href="{{ @$company->linkedin }}" target="blank" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
                  </div>
               </div>
            </div>
         </div>
         <div class="copyright">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="footer-ft">
                        {{-- <p>Copyright © 2021 {{ @$company->name }}. All rights reserved. Powered By <a href="https://nerasoft.app/n/" class="text-white" target="blank">Nera Soft</a></p> --}}
                        <p>Copyright © 2025 {{ @$company->name }}. All rights reserved by KSP Smart Pvt Ltd. </p>
                        <p>Designed and developed by <a href="https://nerasoft.in" target="_blank">Nerasoft</a></p>

                     </div>
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!--End Footer-->

      <!--contact popup start-->
      <div id="modal_aside_right" class="modal fixed-left fade" tabindex="-1" role="dialog">
         <div class="modal-dialog modal-lg modal-dialog-aside" role="document"> <!-- Added modal-lg for large modal -->
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title">Express Your Interest!</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="form-block border0 noshadow mt30">
                        <form class="shake" method="post" enctype="multipart/form-data" action="{{ route('front.lead')}}" onSubmit="return valid()">
                           @csrf
                           <div class="row">
                               <div class="form-group col-sm-6">
                                   <input type="text" class="form-control" id="full_name" placeholder="Full Name:" required data-error="Please fill Out" name="full_name" value="{{ old('full_name') }}">
                                   <span id="full_name_error" class="error-text text-danger"></span>
                                   <div class="help-block with-errors"></div>
                                   @error('full_name')
                                       <div class="text-danger">{{ $message }}</div>
                                   @enderror
                               </div>


                               <!--<div class="form-group col-sm-4">-->
                               <!--    <input type="text" class="form-control" id="father_name" placeholder="Father Name" required data-error="Please fill Out" name="father_name" value="{{ old('father_name') }}">-->
                               <!--    <div class="help-block with-errors"></div>-->
                               <!--    @error('father_name')-->
                               <!--        <div class="text-danger">{{ $message }}</div>-->
                               <!--    @enderror-->
                               <!--</div>-->
                               <div class="form-group col-sm-6">
                                 <input type="text" class="form-control" id="email" placeholder="Email Id" required data-error="Please fill Out" name="email" value="{{ old('email') }}">
                                 <span id="email_error" class="error-text text-danger"></span>
                                 <div class="help-block with-errors"></div>
                                 @error('email')
                                     <div class="text-danger">{{ $message }}</div>
                                 @enderror
                             </div>
                              <div class="form-group col-sm-6">
                                   <input type="text" class="form-control" id="mobile_no" placeholder="Mobile No:" required data-error="Please fill Out" name="mobile_no" value="{{ old('mobile_no') }}">
                                   <span id="mobile_no_error" class="error-text text-danger"></span>
                                   <div class="help-block with-errors"></div>
                                   @error('mobile_no')
                                       <div class="text-danger">{{ $message }}</div>
                                   @enderror
                               </div>
                               <!--<div class="form-group col-sm-4">-->
                               <!--    <input type="date" class="form-control" id="date_of_birth" placeholder="Date of Birth" required data-error="Please fill Out" name="date_of_birth" value="{{ old('date_of_birth') }}">-->
                               <!--    <div class="help-block with-errors"></div>-->
                               <!--    @error('date_of_birth')-->
                               <!--        <div class="text-danger">{{ $message }}</div>-->
                               <!--    @enderror-->
                               <!--</div>-->

                               <div class="form-group col-sm-6">
                                   <input type="text" class="form-control" id="address" placeholder="Residence Address" required data-error="Please fill Out" name="address" value="{{ old('address') }}">
                                   <div class="help-block with-errors"></div>
                                   @error('address')
                                       <div class="text-danger">{{ $message }}</div>
                                   @enderror
                               </div>
                                <div class="form-group col-sm-12">
                                   <select name="service_id" id="service_id" class="form-control" required>
                                       <option value="">Select Service</option>
                                       @if($get_service)
                                           @foreach ($get_service as $service)
                                               <option value="{{ $service->id }}" @if(empty($get_lead)) {{ old('service_id') == $service->id ? 'selected' : '' }} @else {{ (isset($get_lead) && $get_lead->service_id == $service->id) ? 'selected' : '' ; }} @endif>{{ ucwords($service->title) }}</option>
                                           @endforeach
                                       @endif
                                   </select>
                                   <div class="help-block with-errors"></div>
                                   @error('service_id')
                                       <div class="text-danger">{{ $message }}</div>
                                   @enderror
                               </div>
                               <!--<div class="form-group col-sm-4">-->
                               <!--    <input type="text" class="form-control" id="state" placeholder="State Name" required data-error="Please fill Out" name="state" value="{{ old('state') }}">-->
                               <!--    <div class="help-block with-errors"></div>-->
                               <!--    @error('state')-->
                               <!--        <div class="text-danger">{{ $message }}</div>-->
                               <!--    @enderror-->
                               <!--</div>-->

                               <!--<div class="form-group col-sm-4">-->
                               <!--    <input type="text" class="form-control" id="tehsil_taluka" placeholder="Tehsil/Taluka Name" required data-error="Please fill Out" name="tehsil_taluka" value="{{ old('tehsil_taluka') }}">-->
                               <!--    <div class="help-block with-errors"></div>-->
                               <!--    @error('tehsil_taluka')-->
                               <!--        <div class="text-danger">{{ $message }}</div>-->
                               <!--    @enderror-->
                               <!--</div>-->

                               <!--<div class="form-group col-sm-4">-->
                               <!--    <input type="text" class="form-control" id="pin_code" placeholder="Pin Code" required data-error="Please fill Out" name="pin_code" value="{{ old('pin_code') }}">-->
                               <!--    <div class="help-block with-errors"></div>-->
                               <!--    @error('pin_code')-->
                               <!--        <div class="text-danger">{{ $message }}</div>-->
                               <!--    @enderror-->
                               <!--</div>-->
                           </div>

                           <!--<h6 class="section-title text-warning">Occupation Details</h6>-->
                           <!--<div class="row">-->
                           <!--    <div class="form-group col-sm-4">-->
                           <!--        <input type="text" class="form-control" id="income" placeholder="Income" required data-error="Please fill Out" name="income" value="{{ old('income') }}">-->
                           <!--        <div class="help-block with-errors"></div>-->
                           <!--        @error('income')-->
                           <!--            <div class="text-danger">{{ $message }}</div>-->
                           <!--        @enderror-->
                           <!--    </div>-->

                           <!--    <div class="form-group col-sm-4">-->
                           <!--        <input type="text" class="form-control" id="income_proof_name" placeholder="Income Proof Name" required data-error="Please fill Out" name="income_proof_name" value="{{ old('income_proof_name') }}">-->
                           <!--        <div class="help-block with-errors"></div>-->
                           <!--        @error('income_proof_name')-->
                           <!--            <div class="text-danger">{{ $message }}</div>-->
                           <!--        @enderror-->
                           <!--    </div>-->

                               <!-- Hidden Fields for Latitude and Longitude -->
                               <input type="hidden" class="form-control" id="res_lat" name="res_lat">
                               <input type="hidden" class="form-control" id="res_long" name="res_long">
                           <!--    <input type="hidden" class="form-control" id="business_lat" name="business_lat">-->
                           <!--    <input type="hidden" class="form-control" id="business_long" name="business_long">-->


                           <!--</div>-->

                           <!--<h6 class="section-title text-warning">Business/Office Location:</h6>-->
                           <!--<div class="row">-->
                           <!--    <div class="form-group col-sm-4">-->
                           <!--        <input type="text" class="form-control" id="business_address" placeholder="Business Address" required data-error="Please fill Out" name="business_address" value="{{ old('business_address') }}">-->
                           <!--        <div class="help-block with-errors"></div>-->
                           <!--        @error('business_address')-->
                           <!--            <div class="text-danger">{{ $message }}</div>-->
                           <!--        @enderror-->
                           <!--    </div>-->

                           <!--    <div class="form-group col-sm-4">-->
                           <!--        <input type="text" class="form-control" id="business_state" placeholder="State" required data-error="Please fill Out" name="business_state" value="{{ old('business_state') }}">-->
                           <!--        <div class="help-block with-errors"></div>-->
                           <!--        @error('business_state')-->
                           <!--            <div class="text-danger">{{ $message }}</div>-->
                           <!--        @enderror-->
                           <!--    </div>-->

                           <!--    <div class="form-group col-sm-4">-->
                           <!--        <input type="text" class="form-control" id="business_district" placeholder="District" required data-error="Please fill Out" name="business_district" value="{{ old('business_district') }}">-->
                           <!--        <div class="help-block with-errors"></div>-->
                           <!--        @error('business_district')-->
                           <!--            <div class="text-danger">{{ $message }}</div>-->
                           <!--        @enderror-->
                           <!--    </div>-->

                           <!--    <div class="form-group col-sm-4">-->
                           <!--        <input type="text" class="form-control" id="business_tehsil" placeholder="Tehsil" required data-error="Please fill Out" name="business_tehsil" value="{{ old('business_tehsil') }}">-->
                           <!--        <div class="help-block with-errors"></div>-->
                           <!--        @error('business_tehsil')-->
                           <!--            <div class="text-danger">{{ $message }}</div>-->
                           <!--        @enderror-->
                           <!--    </div>-->

                           <!--    <div class="form-group col-sm-4">-->
                           <!--        <input type="text" class="form-control" id="business_pin_code" placeholder="Pin Code" required data-error="Please fill Out" name="business_pin_code" value="{{ old('business_pin_code') }}">-->
                           <!--        <div class="help-block with-errors"></div>-->
                           <!--        @error('business_pin_code')-->
                           <!--            <div class="text-danger">{{ $message }}</div>-->
                           <!--        @enderror-->
                           <!--    </div>-->
                           <!--</div>-->

                           <!--<h6 class="section-title text-warning">Attachments:</h6>-->
                           <!--<div class="row">-->
                           <!--    <div class="form-group col-sm-4">-->
                           <!--        <label class="custom-label">Aadhar Card Front:</label><br>-->
                           <!--        <input type="file" class="form-control" id="aadhar_front_doc" required data-error="Please fill Out" name="aadhar_front_doc" accept="image/*,application/pdf">-->
                           <!--        <div class="help-block with-errors"></div>-->
                           <!--        @error('aadhar_front_doc')-->
                           <!--            <div class="text-danger">{{ $message }}</div>-->
                           <!--        @enderror-->
                           <!--    </div>-->

                           <!--    <div class="form-group col-sm-4">-->
                           <!--        <label class="custom-label">Aadhar Card Back:</label><br>-->
                           <!--        <input type="file" class="form-control" id="aadhar_back_doc" required data-error="Please fill Out" name="aadhar_back_doc" accept="image/*,application/pdf">-->
                           <!--        <div class="help-block with-errors"></div>-->
                           <!--        @error('aadhar_back_doc')-->
                           <!--            <div class="text-danger">{{ $message }}</div>-->
                           <!--        @enderror-->
                           <!--    </div>-->

                           <!--    <div class="form-group col-sm-4">-->
                           <!--        <label class="custom-label">Pan Card:</label><br>-->
                           <!--        <input type="file" class="form-control" id="pan_card_doc" required data-error="Please fill Out" name="pan_card_doc" accept="image/*,application/pdf">-->
                           <!--        <div class="help-block with-errors"></div>-->
                           <!--        @error('pan_card_doc')-->
                           <!--            <div class="text-danger">{{ $message }}</div>-->
                           <!--        @enderror-->
                           <!--    </div>-->

                           <!--    <div class="form-group col-sm-4">-->
                           <!--        <label class="custom-label">Voter ID Card:</label><br>-->
                           <!--        <input type="file" class="form-control" id="voter_id_doc" required data-error="Please fill Out" name="voter_id_doc" accept="image/*,application/pdf">-->
                           <!--        <div class="help-block with-errors"></div>-->
                           <!--        @error('voter_id_doc')-->
                           <!--            <div class="text-danger">{{ $message }}</div>-->
                           <!--        @enderror-->
                           <!--    </div>-->
                           <!--</div>-->

                           <div class="form-group">
                               <textarea id="message" class="form-control" rows="5" placeholder="Enter your message" required name="message">{{ old('message') }}</textarea>
                               <div class="help-block with-errors"></div>
                               @error('message')
                                   <div class="text-danger">{{ $message }}</div>
                               @enderror
                           </div>
                           <input type="text" name="otp" required class="form-control otp_class d-none">
                           <span class="text-success otp_sent d-none">OTP Sent Successfully</span>
                           <span  class="btn-rd w-100 mb-5 otp_button" onclick="sendotp();">Submit </span>
                           <button type="submit" id="form-submit" class="btn-rd w-100  submit_btn d-none">Submit </button>
                           <p class="trm"><i class="fas fa-lock"></i>We hate spam, and we respect your privacy.</p>
                           <div id="msgSubmit" class="h3 text-center hidden"></div>
                           <div class="clearfix"></div>
                       </form>

                         <div class="form-btm-set">
                             <h5>We Deliver</h5>
                             <div class="icon-setss mt20">
                                 <div class="icon-rows">
                                     <div class="icon-imgg"><img src="website_assets/images/icons/money.svg" alt="#"></div>
                                     <div class="icon-txt">
                                         <p>Best Price</p>
                                     </div>
                                 </div>
                                 <div class="icon-rows">
                                     <div class="icon-imgg"><img src="website_assets/images/icons/quality.svg" alt="#"></div>
                                     <div class="icon-txt">
                                         <p>Quality Service</p>
                                     </div>
                                 </div>
                                 <div class="icon-rows">
                                     <div class="icon-imgg"><img src="website_assets/images/icons/call-agent.svg" alt="#"></div>
                                     <div class="icon-txt">
                                         <p>Good Support</p>
                                     </div>
                                 </div>
                                 <div class="icon-rows">
                                     <div class="icon-imgg"><img src="website_assets/images/icons/satisfaction.svg" alt="#"></div>
                                     <div class="icon-txt">
                                         <p>Satisfaction</p>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

      <!--contact popup end-->

      <!-- Main script file -->
      <script src="{{ asset('website_assets/js/jquery.min.js') }}"></script>
      <script src="{{ asset('website_assets/js/bootstrap.min.js') }}"></script>
      <script src="{{ asset('website_assets/js/pora.js.plugin.js') }}"></script>
      <!-- contact from script file -->
      <script src="{{ asset('website_assets/js/validator.min.js') }}"></script>
      <script src="{{ asset('website_assets/js/form-scripts.js') }}"></script>
      <!--common script file-->
      <script src="{{ asset('website_assets/js/main.js') }}"></script>

      <script>
         document.addEventListener("DOMContentLoaded", function() {
             // Function to request location permission
             function requestLocationPermission() {
                 if ("geolocation" in navigator) {
                     // Request the user's location
                     navigator.geolocation.getCurrentPosition(success, error);
                 } else {
                     alert("Geolocation is not supported by this browser.");
                 }
             }

             // Success callback for geolocation
             function success(position) {
                 const latitude = position.coords.latitude;
                 const longitude = position.coords.longitude;

                 // Log the coordinates to the console
                 console.log(`Latitude: ${latitude}, Longitude: ${longitude}`);

                 // Set values to hidden inputs
                 document.getElementById('res_lat').value = latitude;
                 document.getElementById('business_lat').value = latitude;
                 document.getElementById('res_long').value = longitude;
                 document.getElementById('business_long').value = longitude;

             }

             // Error callback for geolocation
             function error(err) {
                 alert(`Error: ${err.message}`);
             }

             // Request location permission when the page loads
             requestLocationPermission();
         });

         function valid()
         {
            let res_lat = $('#res_lat').val();
            if(res_lat=='')
            {
               alert('Please provide your current location.');
               return false;
            }
            return true;
         }
         function sendotp() {
    $('.error-text').text(''); // Clear previous error messages

    const full_name = $('#full_name').val().trim();
    const email = $('#email').val().trim();
    const mobile = $('#mobile_no').val().trim();

    let isValid = true;

    // Full Name Validation
    if (full_name === '') {
        $('#full_name_error').text('Please provide your full name.');
        isValid = false;
    }

    // Email Validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Simple email regex
    if (email === '') {
        $('#email_error').text('Please provide your email.');
        isValid = false;
    } else if (!emailRegex.test(email)) {
        $('#email_error').text('Please provide a valid email address.');
        isValid = false;
    }

    // Mobile Number Validation
    const mobileRegex = /^[0-9]{10}$/; // 10-digit integer regex
    if (mobile === '') {
        $('#mobile_no_error').text('Please provide your mobile number.');
        isValid = false;
    } else if (!mobileRegex.test(mobile)) {
        $('#mobile_no_error').text('Please provide a valid 10-digit mobile number.');
        isValid = false;
    }

    if (!isValid) {
        return false; // Stop execution if validation fails
    }

    // Get CSRF token
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    // Make AJAX request
    $.ajax({
        url: "{{ route('send_otp') }}",
        type: "post",
        data: {
            _token: csrfToken,
            mobile_no: mobile,
        },
        success: function (data) {
            // Handle success response
            $('.otp_class').removeClass('d-none');
            $('.otp_sent').removeClass('d-none');
            $('.submit_btn').removeClass('d-none');
            $('.otp_button').addClass('d-none');
        },
        error: function (xhr) {
            // Handle error response
            alert('An error occurred while sending OTP. Please try again.');
        }
    });
}


     </script>
   </body>
</html>
