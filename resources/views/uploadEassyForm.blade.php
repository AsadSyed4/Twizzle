@extends('layouts.main')
@push('header')
    <title>Upload Eassy | Twizzle</title>
@endpush
@section('section')
    <!-- ====================== Essay Grading ======================== -->
    <div id="sub">
        <div class="title">
            <h1>Essay Grading</h1>
        </div>
        <div class="essay_grading">
            <div class="container">
                <div class="essay_grading_inner">
                    <div class="row">
                        @foreach ($packages as $package)
                            <div class="col">
                                <h1>{{ $package->subscription_name }}</h1>
                                <ul>
                                    {{ $package->description }}
                                </ul>
                                <a href="javascript:void(0)"
                                    onclick="next({{ $package->id }})">${{ $package->sub_price }}</a>
                            </div>
                        @endforeach
                    </div>
                    <div class="description">
                        <p>
                            There are many different ways to build a competitive college application. Your grades, standardized test scores, and the various extracurriculars and events that you take part in all matter. But so much of what you have accomplished needs to be conveyed in words – through a compelling essay that showcases who you are and why you’re different. We provide detailed feedback for each and every essay that comes our way. We’ve thought about how to lower the barrier to make things more practical and customized to your needs. Whether it’s your Common App and Coalition essay, personal statement, or a competition submission, we have you covered. Check out our sample evaluation to see what kind of feedback you’ll receive. 
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="upload" hidden="true">
        <div class="submit">
            <div class="container">
                <div class="submit_inner">
                    <form id="myForm" action="{{ route('UserController.uploadEassy') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <section>
                            <div class="heading">
                                <h1>Submit</h1>
                                <h2>
                                    Essay
                                    <span class="before"></span>
                                    <span class="after"></span>
                                </h2>
                            </div>
                            <div>
                                <span>
                                    <label for="university">Select university</label>
                                    <span class="select">
                                        <select name="university" id="university">
                                            <option value="ABC">ABC</option>
                                            <option value="DEF">DEF</option>
                                            <option value="GHI">GHI</option>
                                        </select>
                                        <i class="fas fa-caret-down"></i>
                                    </span>
                                </span>
                                <span>
                                    <label for="Upload">Upload Essay</label>
                                    <div class="upload_file">
                                        <i class="fal fa-cloud-upload"></i>
                                        <p id="file_name">Browse and chose the files you want to upload from your computer
                                        </p>
                                        <label> Browse File
                                            <input type="file" name="eassy" accept=".pdf,.docs" required>
                                        </label>
                                    </div>
                                </span>
                                <span>
                                    <img src="{{ asset('front/css/ajax-loader.gif') }}" hidden id="loaderImg" style="margin-left: 45%;">
                                </span>
                                <input type="hidden" name="package" id="package" />
                                <button type="submit" class="planner_btn">Submit</button>                                                                
                            </div>                            
                        </section>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer')
    <script>
        function next(id) {
            $('#package').val(id);
            $('#sub').attr('hidden', true);
            $('#upload').removeAttr('hidden');
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('input[type="file"]').change(function(e) {
                var fileName = e.target.files[0].name;
                $('#file_name').text(fileName);
            });
        });
        $(function() {
            $('#myForm').submit(function() {
                $('#loaderImg').show();
                return true;
            });
        });
    </script>
@endpush
