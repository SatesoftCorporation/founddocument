@php
    $note = 'countries';
@endphp
@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow-none">
                <div class="card-header">
                    <a href="{{ route('admin.countries.create') }}" class="btn fda-bg text-white">
                        <i class="fa fa-plus-circle"></i>
                        add
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center table-hover mb-0 data-table">
                            <thead class="text-uppercase text-sm text-start">
                                <th>no</th>
                                <th>added by</th>
                                <th>country name</th>
                                <th>capital city</th>
                                <th>nationality</th>
                                <th>abbreviation</th>
                                <th>code</th>
                                <th>added on</th>
                                <th>more</th>
                            </thead>
                            <tbody>
                                @php
                                    $counter = 1;
                                @endphp
                                @foreach ($countries as $country)
                                    <tr>
                                        <td>
                                            @php
                                                echo $counter;
                                            @endphp
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="me-2    ">
                                                    <img src="{{ asset('uploads/profiles/' . $country->image) }}"
                                                        class="avatar avatar-md" alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $country->name }}</h6>
                                                    <p class="text-sm text-secondary mb-0">{{ $country->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-sm text-capitalize">
                                            {{ $country->countryName }}
                                        </td>
                                        <td class="align-middle text-sm text-capitalize">
                                            {{ $country->city }}
                                        </td>
                                        <td class="align-middle  text-sm text-capitalize">
                                            {{ $country->nationality }}
                                        </td>
                                        <td class="align-middle text-center text-capitalize">
                                            {{ $country->abbreviation }}
                                        </td>
                                        <td class="align-middle text-center text-capitalize">
                                            {{ $country->code }}
                                        </td>
                                        <td class="align-middle text-center">
                                            {{ $country->created_at->format('d/m/Y') }}
                                        </td>
                                        <td class="align-middle">
                                            <div class="dropdown float-lg-end pe-4">
                                                <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v text-secondary" aria-hidden="true"></i>
                                                </a>
                                                <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5 text-capitalize"
                                                    aria-labelledby="dropdownTable">
                                                    <li>
                                                        <a class="dropdown-item border-radius-md"
                                                            href="{{ route('admin.countries.edit', ['countryId' => $country->id]) }}">
                                                            <i class="fa fa-pen-square"></i>
                                                            edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item border-radius-md" href="javascript:;"
                                                            onclick="viewCountry(
                                                                '{{ $country->countryName }}',
                                                                '{{ $country->abbreviation }}',
                                                                '{{ $country->nationality }}',
                                                                '{{ $country->code }}',
                                                                '{{ $country->created_at }}'
                                                            )">
                                                            <i class="fa fa-eye"></i>
                                                            view
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form
                                                            action="{{ route('admin.countries.destroy', ['countryId' => $country->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="dropdown-item border-radius-md" type="submit"
                                                                onclick="return confirm('Are you sure, you want the delete this country')">
                                                                <i class="fa fa-trash"></i>
                                                                delete
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @php
                                        $counter += 1;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            const viewCountry = (countryName, abbreviation, nationality, code, created_at) => {
                var date = new Date(created_at);
                document.querySelector('.countryName').innerText = countryName;
                document.querySelector('.nationality').innerText = nationality;
                document.querySelector('.countryCode').innerText = code;
                document.querySelector('.abbreviation').innerText = abbreviation;
                document.querySelector('.createdAt').innerText = date.getDate() + '/' + date.getMonth() + '/' + date
                    .getFullYear();
                $('#viewCountryModal').modal('show');
            }
        </script>
    @endpush
@endsection
