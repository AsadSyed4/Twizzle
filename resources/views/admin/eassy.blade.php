@if (session()->has('admin'))
    @extends('admin.layouts.main')
    @push('header')
        <title>Eassys | Twizzle</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    @endpush
    @section('section')
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card overflow-hidden">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Eassys</h5>
                        @if (session()->get('admin.role') == 'Super Admin')
                            <form id="search_form" class="row d-flex justify-content-around"
                                action="{{ route('admin.eassy-search') }}" method="POST">
                                @csrf
                                <div class="col-2">
                                    <select class="form-select" name="s_user" id="s_user">
                                        <option value="">Users</option>
                                        @php
                                            $users = \App\Models\UserModel::orderBy('created_at', 'desc')->get();
                                        @endphp
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->username }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2">
                                    <select class="form-select" name="s_grader" id="s_grader">
                                        <option value="">Essay Grader</option>
                                        @php
                                            $graders = \App\Models\Admins::where('admins_roles_id', '=', 3)
                                                ->orderBy('created_at', 'desc')
                                                ->get();
                                        @endphp
                                        @foreach ($graders as $grader)
                                            <option value="{{ $grader->id }}">{{ $grader->username }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2">
                                    <select class="form-select" name="s_package" id="s_package">
                                        <option value="">Packages</option>
                                        @php
                                            $packages = \App\Models\SubscriptionModel::orderBy('created_at', 'desc')->get();
                                        @endphp
                                        @foreach ($packages as $package)
                                            <option value="{{ $package->id }}">{{ $package->subscription_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <input type="date" class="form-control" name="date" id="date" />
                                </div>
                                <div class="col-3">
                                    <button type="button" id="reset" class="btn btn-primary" hidden
                                        onclick="reset_form()"><i class='bx bx-reset'></i></button>
                                    <button type="submit" class="btn btn-primary"><i
                                            class='bx bx-search-alt-2'></i></button>
                                </div>
                            </form>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#essayModal">
                                <i class='bx bxs-file-plus'></i>
                            </button>
                        @endif
                    </div>
                    @if (count($eassys) > 0)
                        <div class="table-responsive text-nowrap">
                            @if (session()->get('admin.role') == 'Super Admin')
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><button id="assign_btn" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#assignModal" hidden><i
                                                        class='bx bx-list-check'></i></button></th>
                                            <th>Username</th>
                                            <th>Packge</th>
                                            <th>Eassy File</th>
                                            <th>Submitted Time</th>
                                            <th>Assigned To</th>
                                            <th>Grading Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($eassys as $eassy)
                                            <tr>
                                                @php
                                                    $essay_grading = \App\Models\EssayGrading::where('admins_id', '=', $eassy->admins_id)
                                                        ->where('essay_id', '=', $eassy->id)
                                                        ->first();
                                                @endphp
                                                <td>
                                                    @if (is_null($essay_grading) || $essay_grading->status == 'Disapproved')
                                                        <input type="checkbox" name="essay" value="{{ $eassy->id }}"
                                                            onclick="remove()">
                                                    @endif
                                                </td>
                                                <td>{{ $eassy->users->username }}</td>
                                                <td>{{ $eassy->subscription->subscription_name }}</td>
                                                <td><a
                                                        href="{{ url('/download') }}/{{ $eassy->media }}">{{ substr($eassy->media, 7) }}</a>
                                                </td>
                                                <td>
                                                    @if (time_diffrence($eassy->created_at) == '0 days')
                                                        Today
                                                    @else
                                                        {{ time_diffrence($eassy->created_at) }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (!is_null($eassy->admins))
                                                        {{ $eassy->admins->username }}
                                                    @else
                                                        <span class="badge bg-info">Not Assigned</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (is_null($essay_grading))
                                                        <span class="badge bg-warning">Not Graded</span>
                                                    @else
                                                        @if ($essay_grading->status == 'Pending')
                                                            <select id="g_status_{{ $essay_grading->id }}"
                                                                class="form-select"
                                                                onchange="grading_status({{ $essay_grading->id }})">
                                                                <option>Grading Status</option>
                                                                <option value="Approved">Approve</option>
                                                                <option value="Disapproved">Disapprove</option>
                                                            </select>
                                                        @elseif ($essay_grading->status == 'Approved')
                                                            <span class="badge bg-success">Approved</span>
                                                        @elseif ($essay_grading->status == 'Disapproved')
                                                            <span class="badge bg-danger">Not Approved</span>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (!is_null($essay_grading))
                                                        <a href="{{ url('/admin/view-grading/' . $eassy->id) }}"
                                                            class="btn btn-primary"><i class='bx bxs-download'></i></a>
                                                    @else
                                                        <span class="badge bg-info">Not Graded</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Username</th>
                                            <th>Packge</th>
                                            <th>Eassy File</th>
                                            <th>Submitted Time</th>
                                            <th>Grading Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $i = 1;
                                    @endphp
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($eassys as $eassy)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $eassy->users->username }}</td>
                                                <td>{{ $eassy->subscription->subscription_name }}</td>
                                                <td>
                                                    <a
                                                        href="{{ url('/download') }}/{{ $eassy->media }}">{{ substr($eassy->media, 7) }}</a>
                                                </td>
                                                <td>
                                                    @if (time_diffrence($eassy->created_at) == '0 days')
                                                        Today
                                                    @else
                                                        {{ time_diffrence($eassy->created_at) }}
                                                    @endif
                                                </td>
                                                @php
                                                    $essay_grading = \App\Models\EssayGrading::where('admins_id', '=', $eassy->admins_id)
                                                        ->where('essay_id', '=', $eassy->id)
                                                        ->first();
                                                @endphp
                                                <td>
                                                    @if (is_null($essay_grading))
                                                        <span class="badge bg-warning">Not Graded</span>
                                                    @else
                                                        @if ($essay_grading->status == 'Pending')
                                                            <span class="badge bg-info">Pending</span>
                                                        @elseif ($essay_grading->status == 'Approved')
                                                            <span class="badge bg-success">Approved</span>
                                                        @elseif ($essay_grading->status == 'Disapproved')
                                                            <span class="badge bg-danger">Not Approved</span>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (!is_null($essay_grading))
                                                        <a href="{{ url('/admin/view-grading/' . $eassy->id) }}"
                                                            class="btn btn-primary"><i class='bx bxs-download'></i></a>
                                                    @else
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#gradingModal{{ $eassy->id }}">
                                                            Grading
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    @else
                        <div class="container d-flex justify-content-center">
                            <h5>No Eassy Yet</h5>
                        </div>
                    @endif
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        {{ $eassys->render() }}
                    </ul>
                </nav>
            </div>
        </div>
        @if (session()->get('admin.role') != 'Super Admin')
            <section>
                @foreach ($eassys as $essay)
                    @if (is_null($essay_grading))
                        <div class="modal fade" id="gradingModal{{ $essay->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Grading</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.eassy-grading') }}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{ $essay->id }}" name="essay_id" />
                                            <input type="hidden" value="{{ $essay->user_id }}" name="user_id" />
                                            <input type="hidden" value="{{ session()->get('admin.id') }}"
                                                name="admin_id" />
                                            <div class="form-outline mb-4">
                                                <label class="form-label justify-center">Grammar Grading</label>
                                                <div class="row">
                                                    <div class="col-1"></div>
                                                    <div class="col-1">
                                                        <input type="radio" id="grammar_grading_1"
                                                            name="grammar_grading" value="1" />
                                                        <label class="form-label bold" for="grammar_grading_1"
                                                            style="font-size: 15px">1</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="grammar_grading_2"
                                                            name="grammar_grading" value="2" />
                                                        <label class="form-label bold" for="grammar_grading_2"
                                                            style="font-size: 15px">2</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="grammar_grading_3"
                                                            name="grammar_grading" value="3" />
                                                        <label class="form-label bold" for="grammar_grading_3"
                                                            style="font-size: 15px">3</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="grammar_grading_4"
                                                            name="grammar_grading" value="4" />
                                                        <label class="form-label bold" for="grammar_grading_4"
                                                            style="font-size: 15px">4</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="grammar_grading_5"
                                                            name="grammar_grading" value="5" />
                                                        <label class="form-label bold" for="grammar_grading_5"
                                                            style="font-size: 15px">5</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="grammar_grading_6"
                                                            name="grammar_grading" value="6" />
                                                        <label class="form-label bold" for="grammar_grading_6"
                                                            style="font-size: 15px">6</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="grammar_grading_7"
                                                            name="grammar_grading" value="7" />
                                                        <label class="form-label bold" for="grammar_grading_7"
                                                            style="font-size: 15px">7</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="grammar_grading_8"
                                                            name="grammar_grading" value="8" />
                                                        <label class="form-label bold" for="grammar_grading_8"
                                                            style="font-size: 15px">8</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="grammar_grading_9"
                                                            name="grammar_grading" value="9" />
                                                        <label class="form-label bold" for="grammar_grading_9"
                                                            style="font-size: 15px">9</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="grammar_grading_10"
                                                            name="grammar_grading" value="10" />
                                                        <label class="form-label bold" for="grammar_grading_10"
                                                            style="font-size: 15px">10</label>
                                                    </div>
                                                    <div class="col-1"></div>
                                                </div>
                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="name">Grammar Note</label>
                                                <textarea class="form-control" id="grammar_note" name="grammar_note" placeholder="Type here"></textarea>
                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label justify-center">Content Grading</label>
                                                <div class="row">
                                                    <div class="col-1"></div>
                                                    <div class="col-1">
                                                        <input type="radio" id="content_grading_1"
                                                            name="content_grading" value="1" />
                                                        <label class="form-label bold" for="content_grading_1"
                                                            style="font-size: 15px">1</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="content_grading_2"
                                                            name="content_grading" value="2" />
                                                        <label class="form-label bold" for="content_grading_2"
                                                            style="font-size: 15px">2</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="content_grading_3"
                                                            name="content_grading" value="3" />
                                                        <label class="form-label bold" for="content_grading_3"
                                                            style="font-size: 15px">3</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="content_grading_4"
                                                            name="content_grading" value="4" />
                                                        <label class="form-label bold" for="content_grading_4"
                                                            style="font-size: 15px">4</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="content_grading_5"
                                                            name="content_grading" value="5" />
                                                        <label class="form-label bold" for="content_grading_5"
                                                            style="font-size: 15px">5</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="content_grading_6"
                                                            name="content_grading" value="6" />
                                                        <label class="form-label bold" for="content_grading_6"
                                                            style="font-size: 15px">6</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="content_grading_7"
                                                            name="content_grading" value="7" />
                                                        <label class="form-label bold" for="content_grading_7"
                                                            style="font-size: 15px">7</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="content_grading_8"
                                                            name="content_grading" value="8" />
                                                        <label class="form-label bold" for="content_grading_8"
                                                            style="font-size: 15px">8</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="content_grading_9"
                                                            name="content_grading" value="9" />
                                                        <label class="form-label bold" for="content_grading_9"
                                                            style="font-size: 15px">9</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="content_grading_10"
                                                            name="content_grading" value="10" />
                                                        <label class="form-label bold" for="content_grading_10"
                                                            style="font-size: 15px">10</label>
                                                    </div>
                                                    <div class="col-1"></div>
                                                </div>
                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="name">Content Note</label>
                                                <textarea class="form-control" id="content_note" name="content_note" placeholder="Type here"></textarea>
                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label justify-center">Structure Grading</label>
                                                <div class="row">
                                                    <div class="col-1"></div>
                                                    <div class="col-1">
                                                        <input type="radio" id="structure_grading_1"
                                                            name="structure_grading" value="1" />
                                                        <label class="form-label bold" for="structure_grading_1"
                                                            style="font-size: 15px">1</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="structure_grading_2"
                                                            name="structure_grading" value="2" />
                                                        <label class="form-label bold" for="structure_grading_2"
                                                            style="font-size: 15px">2</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="structure_grading_3"
                                                            name="structure_grading" value="3" />
                                                        <label class="form-label bold" for="structure_grading_3"
                                                            style="font-size: 15px">3</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="structure_grading_4"
                                                            name="structure_grading" value="4" />
                                                        <label class="form-label bold" for="structure_grading_4"
                                                            style="font-size: 15px">4</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="structure_grading_5"
                                                            name="structure_grading" value="5" />
                                                        <label class="form-label bold" for="structure_grading_5"
                                                            style="font-size: 15px">5</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="structure_grading_6"
                                                            name="structure_grading" value="6" />
                                                        <label class="form-label bold" for="structure_grading_6"
                                                            style="font-size: 15px">6</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="structure_grading_7"
                                                            name="structure_grading" value="7" />
                                                        <label class="form-label bold" for="structure_grading_7"
                                                            style="font-size: 15px">7</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="structure_grading_8"
                                                            name="structure_grading" value="8" />
                                                        <label class="form-label bold" for="structure_grading_8"
                                                            style="font-size: 15px">8</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="structure_grading_9"
                                                            name="structure_grading" value="9" />
                                                        <label class="form-label bold" for="structure_grading_9"
                                                            style="font-size: 15px">9</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="structure_grading_10"
                                                            name="structure_grading" value="10" />
                                                        <label class="form-label bold" for="structure_grading_10"
                                                            style="font-size: 15px">10</label>
                                                    </div>
                                                    <div class="col-1"></div>
                                                </div>
                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="name">Structure Note</label>
                                                <textarea class="form-control" id="structure_note" name="structure_note" placeholder="Type here"></textarea>
                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label justify-center">Final Thought Grading</label>
                                                <div class="row">
                                                    <div class="col-1"></div>
                                                    <div class="col-1">
                                                        <input type="radio" id="final_thought_grading_1"
                                                            name="final_thought_grading" value="1" />
                                                        <label class="form-label bold" for="final_thought_grading_1"
                                                            style="font-size: 15px">1</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="final_thought_grading_2"
                                                            name="final_thought_grading" value="2" />
                                                        <label class="form-label bold" for="final_thought_grading_2"
                                                            style="font-size: 15px">2</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="final_thought_grading_3"
                                                            name="final_thought_grading" value="3" />
                                                        <label class="form-label bold" for="final_thought_grading_3"
                                                            style="font-size: 15px">3</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="final_thought_grading_4"
                                                            name="final_thought_grading" value="4" />
                                                        <label class="form-label bold" for="final_thought_grading_4"
                                                            style="font-size: 15px">4</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="final_thought_grading_5"
                                                            name="final_thought_grading" value="5" />
                                                        <label class="form-label bold" for="final_thought_grading_5"
                                                            style="font-size: 15px">5</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="final_thought_grading_6"
                                                            name="final_thought_grading" value="6" />
                                                        <label class="form-label bold" for="final_thought_grading_6"
                                                            style="font-size: 15px">6</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="final_thought_grading_7"
                                                            name="final_thought_grading" value="7" />
                                                        <label class="form-label bold" for="final_thought_grading_7"
                                                            style="font-size: 15px">7</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="final_thought_grading_8"
                                                            name="final_thought_grading" value="8" />
                                                        <label class="form-label bold" for="final_thought_grading_8"
                                                            style="font-size: 15px">8</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="final_thought_grading_9"
                                                            name="final_thought_grading" value="9" />
                                                        <label class="form-label bold" for="final_thought_grading_9"
                                                            style="font-size: 15px">9</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="radio" id="final_thought_grading_10"
                                                            name="final_thought_grading" value="10" />
                                                        <label class="form-label bold" for="final_thought_grading_10"
                                                            style="font-size: 15px">10</label>
                                                    </div>
                                                    <div class="col-1"></div>
                                                </div>
                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="name">Final Thought Note</label>
                                                <textarea class="form-control" id="final_thought_note" name="final_thought_note" placeholder="Type here"></textarea>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <button type="submit"
                                                    class="btn btn-primary btn-block mb-4">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </section>
        @else
            <div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Assign To</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.add-admin') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group mb-4">
                                        <select id="assign" class="form-select" name="grader_id">
                                            @foreach ($admins as $admin)
                                                <option value="{{ $admin->id }}" @selected($eassy->admins_id == $admin->id)>
                                                    {{ $admin->username }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                            aria-label="Close" onclick="assign_to()">Assign</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="essayModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Submit Essay</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.upload-user-essay') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group mb-4">
                                        <select id="user_id" class="form-control-lg" name="user_id" required>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->username }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-4">
                                        <select id="package_id" class="form-select" name="package_id" required>
                                            @foreach ($packages as $package)
                                                <option value="{{ $package->id }}">
                                                    {{ $package->subscription_name }} (${{ $package->sub_price }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-4">
                                        <input type="file" class="form-control" name="eassy" id="eassy"
                                            placeholder="Upload Eassy" accept=".pdf,.docs" required>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endsection
    @if (session()->get('admin.role') == 'Super Admin')
        @push('footer')
            <script>
                function remove() {
                    $('#assign_btn').removeAttr('hidden');
                }

                function assign_to() {
                    var admin_id = $("#assign option:selected").val();
                    var essay = '';
                    $.map($('input[name="essay"]:checked'), function(c) {
                        essay = essay + "," + c.value;
                    })
                    console.log(essay);
                    if (essay.length !== 0) {
                        if (admin_id.length !== 0) {
                            $.ajax({
                                url: "{{ route('admin.eassy-assign-to') }}",
                                data: {
                                    'admin_id': admin_id,
                                    'essay': essay,
                                    '_token': '{{ csrf_token() }}'
                                },
                                type: 'POST',
                                success: function(data) {
                                    if (data.success) {
                                        iziToast.success({
                                            position: 'topRight',
                                            message: data.message,
                                        });
                                        window.location.reload();
                                    } else {
                                        iziToast.error({
                                            position: 'topRight',
                                            message: data.message,
                                        });
                                    }
                                }
                            });
                        } else {
                            iziToast.warning({
                                position: 'topRight',
                                message: 'Please select a grader',
                            });
                        }
                    } else {
                        iziToast.warning({
                            position: 'topRight',
                            message: 'Please select essay',
                        });
                    }
                }

                function grading_status(id) {
                    var status = $("#g_status_" + id + " option:selected").val();
                    if (status.length !== 0) {
                        $.ajax({
                            url: "{{ route('admin.grading-status') }}",
                            data: {
                                'id': id,
                                'status': status,
                                '_token': '{{ csrf_token() }}'
                            },
                            type: 'POST',
                            success: function(data) {
                                if (data.success) {
                                    iziToast.success({
                                        position: 'topRight',
                                        message: data.message,
                                    });
                                    window.location.reload();
                                } else {
                                    iziToast.error({
                                        position: 'topRight',
                                        message: data.message,
                                    });
                                }
                            }
                        });
                    } else {
                        iziToast.warning({
                            position: 'topRight',
                            message: 'Please select grading status',
                        });
                    }
                }
            </script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            <script>
                $(document).ready(function() {
                    // Select2 Multiple
                    $('#user_id').select2({
                        width: '100%',
                        placeholder: "Select User",
                        dropdownParent: $("#essayModal")
                    });

                });

                function reset_form() {
                    $('#s_user').prop('selectedIndex', 0);
                    $('#s_grader').prop('selectedIndex', 0);
                    $('#s_package').prop('selectedIndex', 0);
                    $('#date').val('');
                    $('#reset').attr('hidden', 'true');
                }
            </script>
        @endpush
    @endif
@else
    <script>
        window.location.replace("{{ route('admin.login') }}");
    </script>
@endif
