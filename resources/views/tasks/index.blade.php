@extends('layouts.app')

@section('content')

    <!-- Bootstrap шаблон... -->

    <div class="panel-body">
        <!-- Текущие задачи -->
        <a href="{{ route('tasks.create') }}" class="btn btn-success"><i class="fa fa-plus"> Новая задача</i></a>
        @if (count($tasks) > 0)
            <div class="panel panel-default">
                <div class="panel-heading">
                    Текущие задачи
                </div>

                <div class="panel-body">
                    <table class="table table-striped task-table">

                        <!-- Заголовок таблицы -->
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>Действие</th>
                        </thead>
                        </tr>

                        <!-- Тело таблицы -->
                        <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <!-- Имя задачи -->
                                <td class="table-text">
                                    <div>{{ $task->name }}</div>
                                </td>

                                <td>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                        {{ method_field('DELETE')}}
                                        {{ csrf_field() }}
                                        <button class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                                        {{ method_field('PUT')}}
                                        {{ csrf_field() }}
                                        <button class="btn btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection