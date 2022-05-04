<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>

<h2>v_orderhenkan_shiirei</h2>

<table>
    <tr>
        <th>orderbango</th>
        <th>syukkosakibango</th>
        <th>unsoumei</th>
        <th>toiawasebango</th>
        <th>konpousu</th>
        <th>touchakudate</th>
        <th>touchakutime</th>
        <th>bikou1</th>
        <th>bikou2</th>
        <th>denpyoname</th>
        <th>dataint01</th>
        <th>dataint02</th>
        <th>dataint03</th>
        <th>datachar01</th>
        <th>datachar02</th>
        <th>datachar03</th>
        <th>datanum0001</th>
        <th>datanum0002</th>
        <th>datatxt0001</th>
        <th>datatxt0002</th>
        <th>datanum0008</th>
        <th>datanum0009</th>
        <th>datanum0010</th>
        <th>datanum0011</th>
        <th>datanum0012</th>
        <th>datanum0013</th>
        <th>datanum0014</th>
        <th>datanum0015</th>
        <th>datanum0016</th>
        <th>datanum0017</th>
        <th>datatxt0019</th>
        <th>datatxt0020</th>
        <th>datatxt0021</th>
        <th>datatxt0022</th>
        <th>datatxt0023</th>
        <th>datatxt0024</th>
        <th>datatxt0025</th>
        <th>datatxt0026</th>
        <th>datatxt0027</th>
        <th>datatxt0028</th>
        <th>name</th>
        <th>ztanka</th>
        <th>ktanka</th>
        <th>datatxt0003</th>
        <th>datatxt0004</th>
        <th>datatxt0005</th>
        <th>yobi1</th>
        <th>yobi2</th>
        <th>deleteflag</th>
    </tr>
    @foreach($v_orderhenkan_shiirei as $key=>$val)
    <tr>
        <td>{{$val->orderbango}}</td>
        <td>{{$val->syukkosakibango}}</td>
        <td>{{$val->unsoumei}}</td>
        <td>{{$val->toiawasebango}}</td>
        <td>{{$val->konpousu}}</td>
        <td>{{$val->touchakudate}}</td>
        <td>{{$val->touchakutime}}</td>
        <td>{{$val->bikou1}}</td>
        <td>{{$val->bikou2}}</td>
        <td>{{$val->denpyoname}}</td>

        <td>{{$val->dataint01}}</td>
        <td>{{$val->dataint02}}</td>
        <td>{{$val->dataint03}}</td>
        <td>{{$val->datachar01}}</td>
        <td>{{$val->datachar02}}</td>
        <td>{{$val->datachar03}}</td>
        <td>{{$val->datanum0001}}</td>
        <td>{{$val->datanum0002}}</td>
        <td>{{$val->datatxt0001}}</td>
        <td>{{$val->datatxt0002}}</td>

        <td>{{$val->datanum0008}}</td>
        <td>{{$val->datanum0009}}</td>
        <td>{{$val->datanum0010}}</td>
        <td>{{$val->datanum0011}}</td>
        <td>{{$val->datanum0012}}</td>
        <td>{{$val->datanum0013}}</td>
        <td>{{$val->datanum0014}}</td>
        <td>{{$val->datanum0015}}</td>
        <td>{{$val->datanum0016}}</td>
        <td>{{$val->datanum0017}}</td>
        <td>{{$val->datatxt0019}}</td>
        <td>{{$val->datatxt0020}}</td>
        <td>{{$val->datatxt0021}}</td>
        <td>{{$val->datatxt0022}}</td>
        <td>{{$val->datatxt0023}}</td>
        <td>{{$val->datatxt0024}}</td>

        <td>{{$val->datatxt0025}}</td>
        <td>{{$val->datatxt0026}}</td>
        <td>{{$val->datatxt0027}}</td>
        <td>{{$val->datatxt0028}}</td>
        <td>{{$val->name}}</td>
        <td>{{$val->ztanka}}</td>
        <td>{{$val->ktanka}}</td>
        <td>{{$val->datatxt0003}}</td>
        <td>{{$val->datatxt0004}}</td>
        <td>{{$val->datatxt0005}}</td>

        <td>{{$val->yobi1}}</td>
        <td>{{$val->yobi2}}</td>
        <td>{{$val->deleteflag}}</td>
    </tr>
    @endforeach
</table>

</body>
</html>
