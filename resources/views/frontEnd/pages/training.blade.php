@extends('frontEnd.layouts.app')
@section('title','প্রশিক্ষণ')

@section('content')
    <!-- ================================
    START BREADCRUMB AREA
================================= -->
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <h2 class="breadcrumb__title">প্রশিক্ষণ</h2>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="{{route('front.index')}}">হোম</a></li>
                            <li>প্রশিক্ষণ</li>
                        </ul>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end hero-area -->
    <!-- ================================
        END BREADCRUMB AREA
    ================================= -->

    <!--======================================
            START CAMPAIGN AREA
    ======================================-->
    <section class="training section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3 border-0 shadow-sm">
                        <div class="row no-gutters">
                            <div class="col-md-7">
                                <img src="{{asset("frontEnd/images/training/eshikkha.png")}}" class="card-img" alt="...">
                            </div>
                            <div class="col-md-5 align-self-center">
                                <div class="card-body">
                                    <h5 class="card-title">ই-শিক্ষা </h5>
                                    <p class="card-text">কম্পিউটার প্রোগ্রামিং শিক্ষাকে সহজ ও কার্যকর করতে, বাংলাদেশ সরকারের আইসিটি মন্ত্রণালয়ের উদ্যোগে নির্মিত হয়েছে ই-শিক্ষা প্ল্যাটফর্ম। প্রজেক্টটি বাস্তবায়ন করেছে বাংলাদেশ কম্পিউটার কাউন্সিল।</p>
                                    <a href="https://www.eshikkha.net/" target="_blank" class="theme-btn btn-sm mt-3">ভিজিট করুন &#187;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card mb-3 border-0 shadow-sm">
                        <div class="row no-gutters">

                            <div class="col-md-5 align-self-center order-2-sm">
                                <div class="card-body">
                                    <h5 class="card-title">মুক্তপাঠ </h5>
                                    <p class="card-text">মুক্তপাঠ’ বাংলা ভাষায় নির্মিত একটি উন্মুক্ত ই-লার্নিং প্লাটফর্ম। এ প্লাটফর্ম থেকে আগ্রহী যে কেউ যে কোনো সময় অনলাইন কোর্সে অংশগ্রহণের মাধ্যমে জ্ঞান ও দক্ষতা অর্জন করতে পারবেন। এখানে রয়েছে সাধারণ শিক্ষা, কারিগরি ও বৃত্তিমূলক শিক্ষা এবং জীবনব্যাপী শিক্ষার সুযোগ। এমনকি বাংলাদেশের সুবিধাবঞ্চিত ও প্রান্তিক জনগোষ্ঠীও ‘মুক্তপাঠ’ থেকে বৃত্তিমূলক শিক্ষা গ্রহণ করে আত্মকর্মসংস্থানের সুযোগ পেতে পারেন। </p>
                                    <a href="http://www.muktopaath.gov.bd/" target="_blank" class="theme-btn btn-sm mt-3">ভিজিট করুন &#187;</a>
                                </div>
                            </div>
                            <div class="col-md-7 order-1-sm">
                                <img src="{{asset("frontEnd/images/training/mukkto.png")}}" class="card-img" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card mb-3 border-0 shadow-sm">
                        <div class="row no-gutters">
                            <div class="col-md-7">
                                <img src="{{asset("frontEnd/images/training/10m.png")}}" class="card-img" alt="...">
                            </div>
                            <div class="col-md-5 align-self-center">
                                <div class="card-body">
                                    <h5 class="card-title">রবি ১০ মিনিট স্কুল  </h5>
                                    <p class="card-text">১০ মিনিট স্কুল বা রবি ১০ মিনিট স্কুল হচ্ছে একটি শিক্ষামূলক সংগঠন। এই প্রতিষ্ঠান ফেসবুক ও ইউটিউবের মাধ্যমে শিক্ষা দান করে থাকে। এছাড়াও এদের ওয়েব সাইটে স্মার্টবুক, টেন মিনিট স্কুল ব্লগ, টেন মিনিট স্কুল লাইভ নামে কয়েকটি শাখায় পাঠ্যন্তর্ভুক্ত ও জীবন দক্ষতা বিষয়ক শিক্ষা দান করে। বর্তমানে এই প্রতিষ্ঠানে সাড়ে তেরো লাখ সক্রিয় সদস্য আছে।</p>
                                    <a href="https://10minuteschool.com/" target="_blank" class="theme-btn btn-sm mt-3">ভিজিট করুন &#187;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card mb-3 border-0 shadow-sm">
                        <div class="row no-gutters">

                            <div class="col-md-5 align-self-center">
                                <div class="card-body">
                                    <h5 class="card-title">P-TECH</h5>
                                    <p class="card-text text-justify" style="text-align: justify;">P-TECH হচ্ছে বিশ্বখ্যাত তথ্যপ্রযুক্তি প্রতিষ্ঠান আইবিএম (IBM) এর ই-লার্নিং প্লাটফর্ম। বিশ্বের যেকোনো জায়গা থেকে যেকোনো সময় এবং যেকোনো ডিভাইস থেকে সম্পূর্ণ বিনামূল্যে এই প্লাটফর্ম থেকে কোর্স করা যাবে। শিক্ষার্থী থেকে শুরু করে যারা কাজ খুঁজছেন এমনকি যারা কোনো প্রতিষ্ঠানে কাজ করছেন তাদের জন্য P-TECH একটি দারুণ প্লাটফর্ম। তথ্যপ্রযুক্তি খাতে আগামীদিনের কর্মসংস্থান কেমন হবে সেটি বিবেচনায় রেখেই এখনে কোর্স নির্বাচন ও সাজানো হয়েছে। একজনের দক্ষতা ও যোগ্যতার ভিত্তিতে তার জন্য উপযুক্ত কোর্স নির্বাচনে P-TECH স্বয়ংক্রিয়ভাবে পরামর্শ দিয়ে থাকে। এই বৈশিষ্ট্যের কারণে P-TECH অন্যান্য ই-লার্নিং প্লাটফর্ম থেকে আলাদা এবং কার্যকর।</p>
                                    <a href="https://www.ptech.org/" target="_blank" class="theme-btn btn-sm mt-3">ভিজিট করুন &#187;</a>
                                </div>
                            </div>

                            <div class="col-md-7">
                                <img src="{{asset("frontEnd/images/training/ptech.png")}}" class="card-img h-100" alt="..." >
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
    <!-- end campaign-area -->
    <!--======================================
            END CAMPAIGN AREA
    ======================================-->
@stop

