<?php 
include "controllers/mainController.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>STRASOURCING - Sweet Alerts UI Kit</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/structure.css" rel="stylesheet" type="text/css" class="structure" />
    <link rel="stylesheet" type="text/css" href="../assets/css/structure-minimal.css">
    <link href="../assets/css/structure-minimal.css" rel="stylesheet" type="text/css" class="structure" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="../assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <script src="../plugins/sweetalerts/promise-polyfill.js"></script>
    <link href="../plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
</head>
<body class="sidebar-noneoverflow" data-spy="scroll" data-target="#navSection" data-offset="100">
    
    <!--  BEGIN NAVBAR  -->
    <?php include "partials/navbar.php"?>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="cs-overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <?php include "partials/sidebar.php"?>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="container">

                <div class="container">

                    <div class="page-header">
                        <div class="page-title">
                            <h3>SweetAlerts</h3>
                        </div>
                    </div>

                    <div id="navSection" data-spy="affix" class="nav  sidenav">
                        <div class="sidenav-content">
                            <a href="#saBasic" class="active nav-link">Basic</a>
                            <a href="#saMessage" class="nav-link">Message</a>
                            <a href="#saDynamic" class="nav-link">Dynamic</a>
                            <a href="#satitle" class="nav-link">A title with text</a>
                            <a href="#saChaining" class="nav-link">Chaining modals</a>
                            <a href="#saAnimation" class="nav-link">Animation</a>
                            <a href="#saAuto" class="nav-link">Auto close timer</a>
                            <a href="#saImage" class="nav-link">Custom image</a>
                            <a href="#saHTML" class="nav-link">Custom HTML</a>
                            <a href="#saWarning" class="nav-link">Warning message</a>
                            <a href="#saCancel" class="nav-link">Cancel</a>
                            <a href="#saCustom" class="nav-link">Custom Style</a>
                            <a href="#saFooter" class="nav-link">Footer</a>
                            <a href="#saRTL" class="nav-link">RTL</a>
                            <a href="#saMixin" class="nav-link">Mixin</a>
                        </div>
                    </div>

                    <div class="row layout-top-spacing" id="cancel-row">

                        <div id="saBasic" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">                                
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Basic message</h4>
                                        </div>
                                    </div>
                                </div>                            
                                <div class="widget-content widget-content-area text-center">
                                    <button class="mr-2 btn btn-primary message">Basic message</button>

                                    <div class="code-section-container show-code">
                                                
                                        <button class="btn toggle-code-snippet"><span>Code</span></button>

                                        <div class="code-section text-left">
                                            <pre>
                                                <button class="mr-2 btn btn-primary message">Basic message</button>
                                                <script>
                                                $('.widget-content .message').on('click', function () {
                                                  swal({
                                                      title: 'Saved succesfully',
                                                      padding: '2em'
                                                    })
                                                })
												</script>
                                            </pre>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div id="saMessage" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">                                
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Success message</h4>
                                        </div>
                                    </div>
                                </div>                            
                                <div class="widget-content widget-content-area text-center">
                                    <button class="mr-2 btn btn-primary success">Success message!</button>

                                    <div class="code-section-container">
                                                
                                        <button class="btn toggle-code-snippet"><span>Code</span></button>

                                        <div class="code-section text-left">
                                            <pre>
                                                <button class="mr-2 btn btn-primary success">Success message!</button>
                                                <script>
                                                $('.widget-content .success').on('click', function () {
                                                  swal({
                                                      title: 'Good job!',
                                                      text: "You clicked the!",
                                                      type: 'success',
                                                      padding: '2em'
                                                    })
                                                })
												</script>
                                            </pre>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div id="saDynamic" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">                                
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Dynamic queue</h4>
                                        </div>
                                    </div>
                                </div>                            
                                <div class="widget-content widget-content-area text-center">
                                    <button class="mr-2 btn btn-primary dynamic-queue">Dynamic queue</button>

                                    <div class="code-section-container">
                                                
                                        <button class="btn toggle-code-snippet"><span>Code</span></button>

                                        <div class="code-section text-left">
                                            <pre>
												<button class="mr-2 btn btn-primary dynamic-queue">Dynamic queue</button>
												<script>
                                                $('.widget-content .dynamic-queue').on('click', function () {
                                                    const ipAPI = 'https://api.ipify.org?format=json'
                                                    swal.queue([{
                                                        title: 'Your public IP',
                                                        confirmButtonText: 'Show my public IP',
                                                        text:
                                                          'Your public IP will be received ' +
                                                          'via AJAX request',
                                                        showLoaderOnConfirm: true,
                                                        preConfirm: function() {
                                                          return fetch(ipAPI)
                                                            .then(function (response) { 
                                                                return response.json();
                                                            })
                                                            .then(function(data) {
                                                               return swal.insertQueueStep(data.ip)
                                                            })
                                                            .catch(function() {
                                                              swal.insertQueueStep({
                                                                type: 'error',
                                                                title: 'Unable to get your public IP'
                                                              })
                                                            })
                                                        }
                                                    }])
												})
												</script>
                                            </pre>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div id="satitle" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">                                
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>A title with a text under</h4>
                                        </div>
                                    </div>
                                </div>                            
                                <div class="widget-content widget-content-area text-center">
                                    <button class="mr-2 btn btn-primary  title-text">Title &amp; text</button>

                                    <div class="code-section-container">
                                                
                                        <button class="btn toggle-code-snippet"><span>Code</span></button>

                                        <div class="code-section text-left">
                                            <pre>
                                                <button class="mr-2 btn btn-primary title-text">Title text</button>
                                                <script>
                                                $('.widget-content .title-text').on('click', function () {
                                                  swal({
                                                      title: 'The Internet?',
                                                      text: "That thing is still around?",
                                                      type: 'question',
                                                      padding: '2em'
                                                  })
                                                })
												</script>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="saChaining" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">                                
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Chaining modals (queue)</h4>
                                        </div>
                                    </div>
                                </div>                            
                                <div class="widget-content widget-content-area text-center">
                                    <button class="mr-2 btn btn-primary chaining-modals">Chaining modals (queue)</button>

                                    <div class="code-section-container">
                                                
                                        <button class="btn toggle-code-snippet"><span>Code</span></button>

                                        <div class="code-section text-left">
                                            <pre>
                                                <button class="mr-2 btn btn-primary chaining-modals">Chaining modals (queue)</button>
                                                <script>
                                                $('.widget-content .chaining-modals').on('click', function () {
                                                  swal.mixin({
                                                    input: 'text',
                                                    confirmButtonText: 'Next &rarr;',
                                                    showCancelButton: true,
                                                    progressSteps: ['1', '2', '3'],
                                                    padding: '2em',
                                                  }).queue([
                                                    {
                                                      title: 'Question 1',
                                                      text: 'Chaining swal2 modals is easy'
                                                    },
                                                    'Question 2',
                                                    'Question 3'
                                                  ]).then(function(result) {
                                                    if (result.value) {
                                                      swal({
                                                        title: 'All done!',
                                                        padding: '2em',
                                                        html:
                                                          'Your answers: &lt;pre&gt;' +
                                                            JSON.stringify(result.value) +
                                                          '&lt;/pre&gt;',
                                                        confirmButtonText: 'Lovely!'
                                                      })
                                                    }
                                                  })
                                                })
                                                </script>
                                                </pre>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="saAnimation" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">                                
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Custom animation</h4>
                                        </div>
                                    </div>
                                </div>                            
                                <div class="widget-content widget-content-area text-center">
                                    <button class="mr-2 btn btn-primary html-jquery">Custom animation</button>

                                    <div class="code-section-container">
                                                
                                        <button class="btn toggle-code-snippet"><span>Code</span></button>

                                        <div class="code-section text-left">
                                            <pre>
                                                <button class="mr-2 btn btn-primary html-jquery">Custom animation</button>
                                               <script> 
                                                $('.widget-content .html-jquery').on('click', function () {
                                                  swal({
                                                    title: 'Custom animation with Animate.css',
                                                    animation: false,
                                                    customClass: 'animated tada',
                                                    padding: '2em'
                                                  })
                                                })
												</script>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="saAuto" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">                                
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Message with auto close timer</h4>
                                        </div>
                                    </div>
                                </div>                            
                                <div class="widget-content widget-content-area text-center">
                                    <button class="mr-2 btn btn-primary timer">Message timer</button>

                                    <div class="code-section-container">
                                                
                                        <button class="btn toggle-code-snippet"><span>Code</span></button>

                                        <div class="code-section text-left">
                                            <pre>
                                                <button class="mr-2 btn btn-primary timer">Message timer<button>
                                                <script>
                                                $('.widget-content .timer').on('click', function () {
                                                  swal({
                                                    title: 'Auto close alert!',
                                                    text: 'I will close in 2 seconds.',
                                                    timer: 2000,
                                                    padding: '2em',
                                                    onOpen: function () {
                                                      swal.showLoading()
                                                    }
                                                  }).then(function (result) {
                                                    if (
                                                      // Read more about handling dismissals
                                                      result.dismiss === swal.DismissReason.timer
                                                    ) {
                                                      console.log('I was closed by the timer')
                                                    }
                                                  })
                                                })
												</script>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="saImage" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">                                
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Message with custom image</h4>
                                        </div>
                                    </div>
                                </div>                            
                                <div class="widget-content widget-content-area text-center">
                                    <button class="mr-2 btn btn-primary custom-image">Message with custom image</button>

                                    <div class="code-section-container">
                                                
                                        <button class="btn toggle-code-snippet"><span>Code</span></button>

                                        <div class="code-section text-left">
                                            <pre>
                                                <button class="mr-2 btn btn-primary custom-image">Message with custom image</button>
                                                <script>
                                                $('.widget-content .custom-image').on('click', function () {
                                                  swal({
                                                    title: 'Sweet!',
                                                    text: 'Modal with a custom image.',
                                                    imageUrl: 'assets/img/300x300.jpg',
                                                    imageWidth: 400,
                                                    imageHeight: 200,
                                                    imageAlt: 'Custom image',
                                                    animation: false,
                                                    padding: '2em'
                                                  })
                                                })
												</script>
                                            </pre>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div id="saHTML" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">                                
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Custom HTML description and buttons</h4>
                                        </div>
                                    </div>
                                </div>                            
                                <div class="widget-content widget-content-area text-center">
                                    <button class="mr-2 btn btn-primary  html">Custom Description &amp; buttons</button>

                                    <div class="code-section-container">
                                                
                                        <button class="btn toggle-code-snippet"><span>Code</span></button>

                                        <div class="code-section text-left">
                                            <pre>
                                                <button class="mr-2 btn btn-primary html">Custom Description & buttons</button>
                                                <script>
                                                $('.widget-content .html').on('click', function () {
                                                  swal({
                                                    title: '&lt;i&gt;HTML&lt;/i&gt; &lt;u&gt;example&lt;/u&gt;',
                                                    type: 'info',
                                                    html:
                                                      'You can use &lt;b&gt;bold text&lt;/b&gt;, ' +
                                                      '&lt;a href="//github.com"&gt;links&lt;/a&gt; ' +
                                                      'and other HTML tags',
                                                    showCloseButton: true,
                                                    showCancelButton: true,
                                                    focusConfirm: false,
                                                    confirmButtonText:
                                                      '&lt;i class="flaticon-checked-1"&gt;&lt;/i&gt; Great!',
                                                    confirmButtonAriaLabel: 'Thumbs up, great!',
                                                    cancelButtonText:
                                                    '&lt;i class="flaticon-cancel-circle"&gt;&lt;/i&gt; Cancel',
                                                    cancelButtonAriaLabel: 'Thumbs down',
                                                    padding: '2em'
                                                  })
                                                })
                                                </script>
                                            	</pre>    
                                            </pre>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div id="saWarning" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">                                
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Warning message, with "Confirm" button</h4>
                                        </div>
                                    </div>
                                </div>                            
                                <div class="widget-content widget-content-area text-center">
                                    <button class="mr-2 btn btn-primary  warning confirm">Confirm</button>

                                    <div class="code-section-container">
                                                
                                        <button class="btn toggle-code-snippet"><span>Code</span></button>

                                        <div class="code-section text-left">
                                            <pre>
                                                <button class="mr-2 btn btn-primary warning confirm">Confirm</button>
                                                <script>
                                                $('.widget-content .warning.confirm').on('click', function () {
                                                  swal({
                                                      title: 'Are you sure?',
                                                      text: "You won't be able to revert this!",
                                                      type: 'warning',
                                                      showCancelButton: true,
                                                      confirmButtonText: 'Delete',
                                                      padding: '2em'
                                                    }).then(function(result) {
                                                      if (result.value) {
                                                        swal(
                                                          'Deleted!',
                                                          'Your file has been deleted.',
                                                          'success'
                                                        )
                                                      }
                                                    })
                                                })
												</script>
                                            </pre>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div id="saCancel" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">                                
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Execute something else for "Cancel".</h4>
                                        </div>
                                    </div>
                                </div>                            
                                <div class="widget-content widget-content-area text-center">
                                    <button class="mr-2 btn btn-primary  warning cancel">Addition else for "Cancel".</button>

                                    <div class="code-section-container">
                                                
                                        <button class="btn toggle-code-snippet"><span>Code</span></button>

                                        <div class="code-section text-left">
                                            <pre>
                                                <button class="mr-2 btn btn-primary warning cancel">Addition else for "Cancel"</button>
												<script>
                                                $('.widget-content .warning.cancel').on('click', function () {
                                                  const swalWithBootstrapButtons = swal.mixin({
                                                    confirmButtonClass: 'btn btn-success btn-rounded',
                                                    cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                                                    buttonsStyling: false,
                                                  })
                                                
                                                  swalWithBootstrapButtons({
                                                    title: 'Are you sure?',
                                                    text: "You won't be able to revert this!",
                                                    type: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonText: 'Yes, delete it!',
                                                    cancelButtonText: 'No, cancel!',
                                                    reverseButtons: true,
                                                    padding: '2em'
                                                  }).then(function(result) {
                                                    if (result.value) {
                                                      swalWithBootstrapButtons(
                                                        'Deleted!',
                                                        'Your file has been deleted.',
                                                        'success'
                                                      )
                                                    } else if (
                                                      // Read more about handling dismissals
                                                      result.dismiss === swal.DismissReason.cancel
                                                    ) {
                                                      swalWithBootstrapButtons(
                                                        'Cancelled',
                                                        'Your imaginary file is safe :)',
                                                        'error'
                                                      )
                                                    }
                                                  })
                                                })
												</script>	
											</pre>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div id="saCustom" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">                                
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>A message with custom width, padding and background</h4>
                                        </div>
                                    </div>
                                </div>                            
                                <div class="widget-content widget-content-area text-center">
                                    <button class="mr-2 btn btn-primary  custom-width-padding-background">Custom Message</button>

                                    <div class="code-section-container">
                                                
                                        <button class="btn toggle-code-snippet"><span>Code</span></button>

                                        <div class="code-section text-left">
                                            <pre>
                                            	<button class="mr-2 btn btn-primary  custom-width-padding-background">Custom Message</button>
                                                    <script>
                                                    $('.widget-content .custom-width-padding-background').on('click', function () {
                                                      swal({
                                                        title: 'Custom width, padding, background.',
                                                        width: 600,
                                                        padding: "7em",
                                                        customClass: "background-modal",
                                                        background: '#fff url(assets/img/640x426.jpg) no-repeat 100% 100%',
                                                      })
                                                    })
													</script>
                                              </pre>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div id="saFooter" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">                                
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>With Footer</h4>
                                        </div>
                                    </div>
                                </div>                            
                                <div class="widget-content widget-content-area text-center">
                                    <button class="mr-2 btn btn-primary  footer">With Footer</button>

                                    <div class="code-section-container">
                                                
                                        <button class="btn toggle-code-snippet"><span>Code</span></button>

                                        <div class="code-section text-left">
                                            <pre>
                                                <button class="mr-2 btn btn-primary  footer">With Footer</button>
                                                <script>
                                                $('.widget-content .footer').on('click', function () {
                                                  swal({
                                                    type: 'error',
                                                    title: 'Oops...',
                                                    text: 'Something went wrong!',
                                                    footer: '&lt;a href&gt;Why do I have this issue?&lt;/a&gt;',
                                                    padding: '2em'
                                                  })
                                                })
												</script>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="saRTL" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">                                
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>RTL Support</h4>
                                        </div>
                                    </div>
                                </div>                            
                                <div class="widget-content widget-content-area text-center">
                                    <button class="mr-2 btn btn-primary  RTL">RTL</button>

                                    <div class="code-section-container">
                                                
                                        <button class="btn toggle-code-snippet"><span>Code</span></button>

                                        <div class="code-section text-left">
                                            <pre>
                                                <button class="mr-2 btn btn-primary  RTL">RTL</button>
                                                <script>
                                                $('.widget-content .RTL').on('click', function () {
                                                  swal({
                                                    title: 'هل تريد الاستمرار؟',
                                                    confirmButtonText:  'نعم',
                                                    cancelButtonText:  'لا',
                                                    showCancelButton: true,
                                                    showCloseButton: true,
                                                    padding: '2em',
                                                    target: document.getElementById('rtl-container')
                                                  })
                                                  </script>
                                                })
                                            </pre>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div id="saMixin" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">                                
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Mixin</h4>
                                        </div>
                                    </div>
                                </div>                            
                                <div class="widget-content widget-content-area text-center">
                                    <button class="mr-2 btn btn-primary  mixin">Mixin</button>

                                    <div class="code-section-container">
                                                
                                        <button class="btn toggle-code-snippet"><span>Code</span></button>

                                        <div class="code-section text-left">
                                            <pre>
                                                <button class="mr-2 btn btn-primary mixin">Mixin</button>
                                                <script>
                                                $('.widget-content .mixin').on('click', function () {
                                                  const toast = swal.mixin({
                                                    toast: true,
                                                    position: 'top-end',
                                                    showConfirmButton: false,
                                                    timer: 3000,
                                                    padding: '2em'
                                                  });
                                                
                                                  toast({
                                                    type: 'success',
                                                    title: 'Signed in successfully',
                                                    padding: '2em',
                                                  })
                                                
                                                })
												</script>
                                            </pre>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © 2020 <a target="_blank" href="https://designreset.com">DesignReset</a>, All rights reserved.</p>
                </div>
                <div class="footer-section f-section-2">
                    <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>
                </div>
            </div>
        </div>
        <!--  END CONTENT AREA  -->        
    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <script src="../assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="../bootstrap/js/popper.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/app.js"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="../plugins/highlight/highlight.pack.js"></script>
    <script src="../assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY STYLES -->
    
    <!-- BEGIN THEME GLOBAL STYLE -->
    <script src="../assets/js/scrollspyNav.js"></script>
    <script src="../plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="../plugins/sweetalerts/custom-sweetalert.js"></script>
    <!-- END THEME GLOBAL STYLE -->    
</body>
</html>