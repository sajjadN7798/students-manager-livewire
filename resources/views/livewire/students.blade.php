<div>
    @section('title', __('message.attributes.appName'))
    @include('livewire.create')
    @include('livewire.update')
    <section class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if(\Illuminate\Support\Facades\Session::has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    @error('invalidLocale')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h1>
                                        {{ __('message.attributes.studentsList') }}
                                    </h1>
                                </div>
                                <div
                                    class="col-6 {{ App::getLocale() === "fa" ? 'text-end' : 'text-start' }} align-self-center">
                                    <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                            data-bs-target="#add-student-modal" wire:click="resetInputs">
                                        + {{ __('message.attributes.addStudent') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-12">
                                <form>
                                    <div class="form-group">
                                        <label for="search"
                                               class="form-label">{{ __('message.attributes.search') }}</label>
                                        <input type="search" class="form-control" id="search"
                                               placeholder="{{__('message.attributes.searchBy')}}"
                                               wire:model.debounce.500ms="query"/>
                                    </div>
                                </form>
                            </div>
                            <table class="table table-striped table-responsive">
                                <thead>
                                <tr>
                                    <th>{{ __('message.attributes.id') }}</th>
                                    <th>{{ __('message.attributes.name') }}</th>
                                    <th>{{ __('message.attributes.lastName') }}</th>
                                    <th>{{ __('message.attributes.email') }}</th>
                                    <th>{{ __('message.attributes.phone') }}</th>
                                    <th>{{ __('message.attributes.operation') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($students))
                                    @foreach($students as $student)
                                        <tr>
                                            <td>{{ $student->id }}</td>
                                            <td>{{ $student->first_name }}</td>
                                            <td>{{ $student->last_name }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>{{ $student->phone_number }}</td>
                                            <td>
                                                <button type="button" class="btn btn-info"
                                                        wire:click.prevent="edit({{ $student->id }})"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#update-student-modal">
                                                    {{ __('message.attributes.edit') }}
                                                </button>
                                                <button type="button" class="btn btn-danger"
                                                        onclick="confirmDialog({{ $student->id }})">
                                                    {{ __('message.attributes.delete') }}
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">{{ __('message.attributes.noDataFound') }}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        {{ $students->links() }}
                                    </div>

                                    <div class="col-xs-12 col-md-6">
                                        <div class="row">
                                            <div class="form-group">
                                                <select class="form-control" id="per-page" wire:model="perPage">
                                                    <option>{{ __('message.attributes.perPage') }}</option>
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="20">20</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
