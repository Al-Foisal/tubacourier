@extends('frontEnd.layouts.master')
@section('title','Update Covarage')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <div class="container">
        <h3 align="center">Covarage Live Data Search</h3><br />
        <div class="row">
            <div class="col-md-6">

            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <select type="text" name="search_area" id="search_area" required="required" class="form-control">
                        <option value="" selected>--select--</option>
                        <option value="inside_dhaka">Inside Dhaka</option>
                        <option value="outside_dhaka">Outside Dhaka</option>
                        <option value="dhaka_suburb">Dhaka Suburb</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" name="area" id="area" class="form-control" placeholder="Enter area" />
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="sorting" data-sorting_type="asc" data-column_name="id" style="cursor: pointer">ID
                            <span id="id_icon"></span>
                        </th>

                        <th scope="col">District</th>

                        <th class="sorting" data-sorting_type="asc" data-column_name="area" style="cursor: pointer">
                            Area <span id="area_icon"></span></th>


                        <th scope="col">Post Code</th>
                        <th scope="col">Home Delivery</th>
                        <th scope="col">Charge(1kg)</th>
                        <th scope="col">Charge(2kg)</th>
                        <th scope="col">Charge(3kg)</th>
                        <th scope="col">COD Charge</th>
                    </tr>
                </thead>
                <tbody>

                    @include('backEnd.covarage.pagination_data')

                </tbody>
            </table>
            <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
            <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
            <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
        </div>
    </div>

    <script>
        $(document).ready(function() {

            function clear_icon() {
                $('#id_icon').html('');
                $('#area_icon').html('');
            }

            function fetch_data(page, sort_type, sort_by, search_area, query) {
                $.ajax({
                    url: "/covarage/fetch_data?page=" + page + "&sortby=" + sort_by + "&sorttype=" +
                        sort_type + "&searcharea=" + search_area + "&query=" + query,
                    success: function(data) {
                        $('tbody').html('');
                        $('tbody').html(data);
                    }
                })
            }

            $(document).on('keyup', '#area', function() {
                var search_area = $('#search_area').val();
                var query = $('#area').val();
                var column_name = $('#hidden_column_name').val();
                var sort_type = $('#hidden_sort_type').val();
                var page = $('#hidden_page').val();
                fetch_data(page, sort_type, column_name, search_area, query);
            });
            
            $('#search_area').change(function(){
                var search_area = $('#search_area').val();
                var query = $('#area').val();
                var column_name = $('#hidden_column_name').val();
                var sort_type = $('#hidden_sort_type').val();
                var page = $('#hidden_page').val();
                fetch_data(page, sort_type, column_name, search_area, query);
            });

            $(document).on('click', '.sorting', function() {
                var column_name = $(this).data('column_name');
                var order_type = $(this).data('sorting_type');
                var reverse_order = '';
                if (order_type == 'asc') {
                    $(this).data('sorting_type', 'desc');
                    reverse_order = 'desc';
                    clear_icon();
                    $('#' + column_name + '_icon').html(
                        '<span class="glyphicon glyphicon-triangle-bottom"></span>');
                }
                if (order_type == 'desc') {
                    $(this).data('sorting_type', 'asc');
                    reverse_order = 'asc';
                    clear_icon
                    $('#' + column_name + '_icon').html(
                        '<span class="glyphicon glyphicon-triangle-top"></span>');
                }
                $('#hidden_column_name').val(column_name);
                $('#hidden_sort_type').val(reverse_order);
                var page = $('#hidden_page').val();
                var search_area = $('#search_area').val();
                var query = $('#area').val();
                fetch_data(page, reverse_order, column_name, search_area, query);
            });

            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page);
                var column_name = $('#hidden_column_name').val();
                var sort_type = $('#hidden_sort_type').val();

                var search_area = $('#search_area').val();
                var query = $('#area').val();

                $('li').removeClass('active');
                $(this).parent().addClass('active');
                fetch_data(page, sort_type, column_name, search_area, query);
            });

        });
    </script>

@endsection