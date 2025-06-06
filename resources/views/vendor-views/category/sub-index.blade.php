@extends('layouts.vendor.app')

@section('title',translate('messages.sub_category'))

@section('content')
    <div class="content container-fluid">
        <div class="card border-0">
            <div class="card-header border-0 py-2">
                <div class="search--button-wrapper justify-content-end">
                    <h2 class="page-header-title card-title text-capitalize">
                        <div class="card-header-icon d-inline-flex mr-2 img">
                            <img src="{{dynamicAsset('/public/assets/admin/img/resturant-panel/page-title/category.png')}}" alt="public">
                        </div>
                        <span>
                            {{translate('messages.sub_category_list')}}<span class="badge badge-soft-dark ml-2" id="itemCount">{{$categories->total()}}</span>
                        </span>
                    </h2>
                    <form  class="search-form ml-auto">

                        <!-- Search -->
                        <div class="input-group input--group">
                            <input id="datatableSearch" value="{{ request()->search ?? null }}"  name="search" type="search" class="form-control" placeholder="{{ translate('Ex : Search by sub categories...') }}" aria-label="{{translate('messages.search_sub_categories')}}">
                            <button class="btn btn--secondary" type="submit">
                                <i class="tio-search"></i>
                            </button>
                        </div>
                        <!-- End Search -->
                    </form>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive datatable-custom">
                    <table id="columnSearchDatatable"
                        class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                        data-hs-datatables-options='{
                            "search": "#datatableSearch",
                            "entries": "#datatableEntries",
                            "isResponsive": false,
                            "isShowPaging": false,
                            "paging":false,
                        }'>
                        <thead class="thead-light">
                            <tr>
                                <th class="w-100px text-center">{{ translate('messages.sl') }}</th>
                                <th class="w-30p text-center">{{translate('messages.id')}}</th>
                                <th class="w-30p">{{translate('messages.category')}}</th>
                                <th class="w-30p">{{translate('messages.sub_category')}}</th>
                            </tr>
                        </thead>

                        <tbody id="set-rows">
                        @foreach($categories as $key=>$category)
                            <tr>
                                <td class="text-center">{{$key+$categories->firstItem()}}</td>
                                <td class="text-center">{{$category->id}}</td>
                                <td>
                                    <span class="d-block font-size-sm text-body">
                                        {{Str::limit($category->parent['name'],20,'...')}}
                                    </span>
                                </td>
                                <td>
                                    <span class="d-block font-size-sm text-body">
                                        {{Str::limit($category->name,20,'...')}}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if(count($categories) === 0)
                    <div class="empty--data">
                        <img src="{{dynamicAsset('/public/assets/admin/img/empty.png')}}" alt="public">
                        <h5>
                            {{translate('no_data_found')}}
                        </h5>
                    </div>
                    @endif
                </div>
            </div>
            <div class="card-footer page-area">
                <!-- Pagination -->
                <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                    <div class="col-sm-auto">
                        <div class="d-flex justify-content-center justify-content-sm-end">
                            <!-- Pagination -->
                            {!! $categories->links() !!}
                        </div>
                    </div>
                </div>
                <!-- End Pagination -->
            </div>
        </div>
    </div>
@endsection

@push('script_2')
    <script>
        "use strict";
        $(document).on('ready', function () {
            // INITIALIZATION OF DATATABLES
            // =======================================================
            let datatable = $.HSCore.components.HSDatatables.init($('#columnSearchDatatable'), {
                select: {
                    style: 'multi',
                    classMap: {
                        checkAll: '#datatableCheckAll',
                        counter: '#datatableCounter',
                        counterInfo: '#datatableCounterInfo'
                    }
                },
                language: {
                    zeroRecords: '<div class="text-center p-4">' +
                    '<img class="mb-3 w-7rem" src="{{dynamicAsset('public/assets/admin/svg/illustrations/sorry.svg')}}" alt="Image Description">' +
                    '<p class="mb-0">{{ translate('No_data_to_show') }}</p>' +
                    '</div>'
                }
            });
            $('#datatableSearch').on('keyup', function () {
                datatable
                    .columns(1)
                    .search(this.value)
                    .draw();
            });

            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                let select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });

    </script>
@endpush
