@extends('layouts.master')

@section('content')

    <div class="three wide column">

        <div class="ui fluid vertical menu">
            <a class="item"> Home </a>
            <a class="item"> Project Review </a>
            <a class="item"> Help </a>
        </div>

    </div>

    <div class="thirteen wide column">

        <div class="ui segments">
            <div class="ui segment">
                <p>Top</p>
            </div>
            <div class="ui secondary segment">
                <table class="ui celled striped table">
                    <thead>
                    <tr>
                        <th colspan="3">
                            Git Repository
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="collapsing">
                            <i class="folder icon"></i> node_modules
                        </td>
                        <td>Initial commit</td>
                        <td class="right aligned collapsing">10 hours ago</td>
                    </tr>
                    <tr>
                        <td>
                            <i class="folder icon"></i> test
                        </td>
                        <td>Initial commit</td>
                        <td class="right aligned">10 hours ago</td>
                    </tr>
                    <tr>
                        <td>
                            <i class="folder icon"></i> build
                        </td>
                        <td>Initial commit</td>
                        <td class="right aligned">10 hours ago</td>
                    </tr>
                    <tr>
                        <td>
                            <i class="file outline icon"></i> package.json
                        </td>
                        <td>Initial commit</td>
                        <td class="right aligned">10 hours ago</td>
                    </tr>
                    <tr>
                        <td>
                            <i class="file outline icon"></i> Gruntfile.js
                        </td>
                        <td>Initial commit</td>
                        <td class="right aligned">10 hours ago</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection