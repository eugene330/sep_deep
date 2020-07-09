@extends('layouts.app')

@section('content')

    <!-- Bootstrap шаблон... -->
    <div class="panel-body">
        <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')

    <!-- Форма отображения задачи -->
        <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        {{method_field('PUT')}}

        <!-- Имя задачи -->
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Изменить задачу</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" class="form-control" value="{{ $task->name }}">
                </div>
            </div>

            <!-- Кнопка сохранения задачи -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-save"></i> Сохранить задачу
                    </button>
                </div>
            </div>

        </form>
    </div>

@endsection