@extends('layouts.master')

@section('content')


    @include('forms.translation-language')


    <div class="column">

        <div class="ui tall stacked segment">

            <div class="ui form">
                <div class="three fields">


                    @include('partials.select', ['name' => 'language', 'collection' => $languages, 'id'=>'translation-language', 'class' => 'no-default'])

                    @include('partials.select', ['name' => 'group', 'collection' => $groups, 'id'=>'translation-group', 'class' => 'no-default'])

                    <div class="nine wide field">
                        <div class="ui right floated basic buttons">

                            <div class="ui icon top left pointing dropdown button">

                                <i class="wrench icon"></i>

                                <div class="menu">
                                    <div class="header">File System</div>
                                    <a class="item" href="{{ route('translation.import') }}"><i
                                                class="level down icon"></i>Import</a>
                                    <a class="item" href="{{ route('translation.export') }}"><i
                                                class="level up icon"></i>Export</a>

                                    <div class="ui divider"></div>
                                    <div class="item" id="translation-new-language"><i class="translate icon"></i>Create
                                        Language
                                    </div>
                                    <div class="item" id="translation-new-group"><i class="tags icon"></i>Create Group
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="ui raised segment">

            <div class="ui fluid icon input loading">
                <input type="text" placeholder="Search...">
                <i class="search icon"></i>
            </div>

        </div>

        <table class="ui celled table">
            <thead>
            <tr>
                <th>Language</th>
                <th>Group</th>
                <th>Key</th>
                <th>Translation</th>
            </tr>
            </thead>
            <tbody>

            @foreach($translations as $translation)
                <tr>
                    <td>{{ $translation->language }}</td>
                    <td>{{ $translation->group }}</td>
                    <td>

                        <div class="ui transparent icon input translation-value">
                            <input data-action="{{ route('translation.update', $translation->id) }}"
                                   data-token="{{ csrf_token() }}"
                                   data-name="key"
                                   type="text"
                                   value="{{ $translation->key }}">
                            <i class="none icon"></i>
                        </div>

                    </td>
                    <td @if(!$translation->value) class="error" @endif>
                        <div class="ui transparent icon input translation-value">
                            <input data-action="{{ route('translation.update', $translation->id) }}"
                                   data-token="{{ csrf_token() }}"
                                   data-name="value"
                                   type="text"
                                   value="{{ $translation->value }}">
                            <i class="none icon"></i>
                        </div>
                    </td>
                </tr>
            @endforeach

            </tbody>
            <tfoot>
            <tr>
                <th colspan="4">

                </th>
            </tr>
            </tfoot>
        </table>
    </div>


@endsection