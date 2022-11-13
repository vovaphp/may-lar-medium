@extends('layouts.app')

@section('content')
    <a href="{{route('task.create')}}" class="btn-success"><i class="fa fa-plus"></i>Create new task </a>
    @if (count($tasks) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Tasks
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Заголовок таблицы -->
                    <thead>
                    <tr>
                        <th>Task</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>

                    <!-- Тело таблицы -->
                    <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <!-- Имя задачи -->
                            <td class="table-text">
                                <div>{{ $task->name }}</div>
                            </td>
                            <td>
                                <div class="distance">
                                    @if ($task->OwnerAuthorise)
                                        <form action="{{ route('task.destroy',$task->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-btn fa-trash"></i> Delete
                                            </button>
                                        </form>
                                        <form action="{{ route('task.edit',$task->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('GET') }}
                                            <button type="submit" class="btn btn-normal">
                                                <i class="fa fa-btn fa-edit"></i> EDIT
                                            </button>
                                        </form>
                                    @else
                                        <button type="submit" class="btn">
                                            <i class="fa fa-btn fa-trash"></i> Delete
                                        </button>
                                        <button type="submit" class="btn">
                                            <i class="fa fa-btn fa-edit"></i> EDIT
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
