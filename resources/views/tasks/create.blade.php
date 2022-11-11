@extends('layouts.app')

@section('content')
    <div class="panel-body">
        <!-- Отображение ошибок проверки ввода -->
        @include('common.errors')
        <!-- Форма новой задачи -->
        <form action="{{ route('task.store') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Имя задачи -->
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Task</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="task" class="form-control" value="{{old('name')}}">
                </div>
            </div>

            <!-- Кнопка добавления задачи -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Create task
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
