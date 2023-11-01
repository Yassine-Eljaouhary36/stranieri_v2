<!-- Modal -->
<div class="search-bar modal fade" id="searchBox" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content py-5 ">
            <div class="modal-header search-body border-0 pb-0">
                <form role="search" method="post" action="{{ route('search') }}" id="search-form"
                    onsubmit="event.preventDefault();">
                    {{ csrf_field() }}
                    <div class="input-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search here..." id="search" />
                    </div>
                </form>
                <button type="button" class="btn-close-search" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="result"> </div>
            </div>
        </div>

    </div>
</div>

@push('styles')
    <style>
        .result>div {
            padding: 10px;
            cursor: pointer;
        }

        .result>.data>div {
            padding: 10px;
            cursor: pointer;
            border-bottom: 1px solid #323232;
        }

        .result {
            height: 300px;
            overflow-y:auto;
        }


        .result a:hover {
            color: #ecbd00 !important;
        }

        .result a {
            color: whitesmoke !important;
        }

        .search-bar .modal-content {
            background-color: #0e1013d9 !important;
        }

        .search-bar .modal-body {
            padding-right: 45px;
        }

        .btn-close-search {
            background: transparent;
            border: none;
            padding-left: 16px;
        }

        .btn-close-search i {
            color: #e5eaf4 !important;
        }


        .search-btn {
            font-size: x-large;
            padding: 5px;
            margin-top: 28px;
        }

        .search-body>form .input-box {
            position: relative;
            height: 76px;
            max-width: 900px;
            width: 100%;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .search-body form .input-box i,
        .search-body form .input-box .button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }

        .search-body form .input-box i {
            left: 20px;
            font-size: 30px;
            color: #707070;
        }

        .search-body form .input-box input {
            height: 100%;
            width: 100%;
            outline: none;
            font-size: 18px;
            font-weight: 400;
            border: none;
            padding: 0 155px 0 65px;
            background-color: transparent;
        }

        .search-body form .input-box .button {
            right: 20px;
            font-size: 16px;
            font-weight: 400;
            color: #fff;
            border: none;
            padding: 12px 30px;
            border-radius: 6px;
            background-color: #ecbd00;
            cursor: pointer;
        }

        .search-body form .input-box .button.clicked {
            transform: translateY(-50%) scale(0.98);
        }

        /* Responsive */
        @media screen and (max-width: 500px) {
            .search-body form .input-box {
                height: 66px;
                margin: 0 8px;
            }

            .search-body form .input-box i {
                left: 12px;
                font-size: 25px;
            }

            .search-body form .input-box input {
                padding: 0 112px 0 50px;
            }

            .search-body form .input-box .button {
                right: 12px;
                font-size: 14px;
                padding: 8px 18px;
            }
        }
    </style>
@endpush
@push('scripts')
    <script src="{{ asset('js/search.js') }}" defer></script>
@endpush