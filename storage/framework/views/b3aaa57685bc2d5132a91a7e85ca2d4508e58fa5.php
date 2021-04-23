<?php $__env->startSection('title'); ?>
    Typeahead
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>

    <link href="<?php echo e(asset('vendors/select2/css/select2.min.css')); ?>" rel="stylesheet" />
    <!--<link rel="stylesheet" href="https://select2.org/assets/a7be624d756ba99faa354e455aed250d.css">-->
    <style>
        body{
            overflow: -webkit-paged-x;
        }
        .select2-container{
            width:100% !important;
        }
        /*github repository css*/
        .select2-result-repository__avatar {
            float: left;
            width: 60px;
            margin-right: 10px;
        }
        .select2-result-repository__avatar img {
            width: 100%;
            height: auto;
            border-radius: 2px;
        }
        .select2-result-repository__meta {
            margin-left: 70px;
        }
    </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <section class="content-header">
        <h1>Typeahead from Database</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo e(route('admin.dashboard')); ?>">
                    <i class="livicon " data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item"><a href="#">Laravel Examples</a></li>
            <li class="breadcrumb-item active">Typeahead</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content pr-3 pl-3">
        <div class="row">
            <div class="col-md-6 col-lg-6 col-12">
                <div class="card ">
                    <div class="card-header bg-primary text-white ">
                        <h4 class="card-title"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Countries
                        </h4>
                    </div>
                    <br />
                    <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <label for="tag_list">Country:</label>
                                    <select id="tag_list" name="tag_list" class="form-control" width="100%"></select>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-12">
                <div class="card ">
                    <div class="card-header bg-primary text-white ">
                        <h4 class="card-title"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Multi Select
                        </h4>
                    </div>
                    <br />
                    <div class="card-body">

                            <form>
                                <div class="form-group">
                                    <label for="multiSelect">Country:</label>
                                    <select id="multiSelect" name="tag_list[]" class="form-control" width="100%" multiple></select>
                                </div>
                            </form>

                    </div>
                </div>
            </div>
            <!-- Multiple select-->


        </div>    <!-- row-->
    </section>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer_scripts'); ?>
    <script language="javascript" type="text/javascript" src="<?php echo e(asset('vendors/select2/js/select2.js')); ?>"></script>
    <script>
        var path = "<?php echo e(route('admin.selectfilter.find')); ?>";
        $('#tag_list').select2({
            placeholder: "Search country...",
            ajax: {
                url: path,
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },

                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
        $('#multiSelect').select2({
            placeholder: "Search country...",
            ajax: {
                url: path,
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
        var storePath = "<?php echo e(route('admin.selectfilter.store')); ?>";
        $("#tagSelect").select2({
            tags: true,
            placeholder: "Search country...",
            ajax: {
                url: path,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            createTag: function(newTag) {
                return {
                    id: newTag.term,
                    text: newTag.term
                };
            }
        });

        $('#tagSelect').on('change', function() {
            var newTag = $('#tagSelect').val();

            var newTagVal = {
                newTag: newTag
            }
            $.ajax({
                url: storePath,
                type:'POST',
                dataType: 'json',
                data: newTagVal
            });
        });
    </script>


    <script>
        $(".js-example-data-ajax").select2({

            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                placeholder: 'select data',
                delay: 250,
                type:"GET",
                headers : false,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;

                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            placeholder: 'Search for a repository',
            escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
            minimumInputLength: 1,
            templateResult: formatRepo,
            templateSelection: formatRepoSelection
        });

        function formatRepo (repo) {
            if (repo.loading) {
                return repo.text;
            }

            var markup = "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__avatar'><img src='" + repo.owner.avatar_url + "' /></div>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'>" + repo.full_name + "</div>";

            if (repo.description) {
                markup += "<div class='select2-result-repository__description'>" + repo.description + "</div>";
            }

            markup += "<div class='select2-result-repository__statistics'>" +
                "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> " + repo.forks_count + " Forks</div>" +
                "<div class='select2-result-repository__stargazers'><i class='fa fa-star'></i> " + repo.stargazers_count + " Stars</div>" +
                "<div class='select2-result-repository__watchers'><i class='fa fa-eye'></i> " + repo.watchers_count + " Watchers</div>" +
                "</div>" +
                "</div></div>";

            return markup;
        }

        function formatRepoSelection (repo) {
            return repo.full_name || repo.text;
        }

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\BSS\resources\views/admin/examples/selectfilter.blade.php ENDPATH**/ ?>