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

<h2>V_Orderhenkan_hatsu</h2>

<table>
    <tr>
        <th>bango</th>
        <th>kokyakubango</th>
        <th>kokyakuorderbango</th>
        <th>orderuserbango</th>
        <th>date</th>
        <th>ordertypebango</th>
        <th>synchroorderbango</th>
        <th>synchroorderbango2</th>
        <th>datachar01</th>
        <th>datachar02</th>
        <th>datachar03</th>
        <th>datachar04</th>
        <th>datachar05</th>
        <th>datachar06</th>
        <th>datachar07</th>
        <th>ordertypebango2</th>
        <th>datachar08</th>
        <th>datachar09</th>
        <th>datachar10</th>
        <th>datachar11</th>
        <th>datachar12</th>
        <th>datachar13</th>
        <th>datachar14</th>
        <th>datachar15</th>
        <th>intorder01</th>
        <th>intorder02</th>
        <th>intorder03</th>
        <th>intorder04</th>
        <th>intorder05</th>
        <th>date0012</th>
        <th>date0013</th>
        <th>date0014</th>
        <th>date0015</th>
        <th>date0016</th>
        <th>date0017</th>
        <th>date0018</th>
        <th>date0019</th>
        <th>date0020</th>
        <th>date0021</th>
        <th>datatxt0147</th>
        <th>datatxt0148</th>
        <th>datatxt0149</th>
        <th>datatxt0150</th>
        <th>datatxt0151</th>
        <th>datatxt0152</th>
        <th>datatxt0153</th>
        <th>datatxt0154</th>
        <th>datatxt0155</th>
        <th>datatxt0156</th>
        <th>datatxt0157</th>
        <th>datatxt0158</th>
        <th>datatxt0159</th>
        <th>datatxt0160</th>
        <th>datatxt0161</th>
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
    @foreach($V_Orderhenkan_hatsu as $key=>$val)
    <tr>
        <td>{{$val->bango}}</td>
        <td>{{$val->kokyakubango}}</td>
        <td>{{$val->kokyakuorderbango}}</td>
        <td>{{$val->orderuserbango}}</td>
        <td>{{$val->date}}</td>
        <td>{{$val->ordertypebango}}</td>
        <td>{{$val->synchroorderbango}}</td>
        <td>{{$val->synchroorderbango2}}</td>
        <td>{{$val->datachar01}}</td>
        <td>{{$val->datachar02}}</td>

        <td>{{$val->datachar03}}</td>
        <td>{{$val->datachar04}}</td>
        <td>{{$val->datachar05}}</td>
        <td>{{$val->datachar06}}</td>
        <td>{{$val->datachar07}}</td>
        <td>{{$val->ordertypebango2}}</td>
        <td>{{$val->datachar08}}</td>
        <td>{{$val->datachar09}}</td>
        <td>{{$val->datachar10}}</td>
        <td>{{$val->datachar11}}</td>

        <td>{{$val->datachar12}}</td>
        <td>{{$val->datachar13}}</td>
        <td>{{$val->datachar14}}</td>
        <td>{{$val->datachar15}}</td>
        <td>{{$val->intorder01}}</td>
        <td>{{$val->intorder02}}</td>
        <td>{{$val->intorder03}}</td>
        <td>{{$val->intorder04}}</td>
        <td>{{$val->intorder05}}</td>
        <td>{{$val->date0012}}</td>

        <td>{{$val->date0013}}</td>
        <td>{{$val->date0014}}</td>
        <td>{{$val->date0015}}</td>
        <td>{{$val->date0016}}</td>
        <td>{{$val->date0017}}</td>
        <td>{{$val->date0018}}</td>
        <td>{{$val->date0019}}</td>
        <td>{{$val->date0020}}</td>
        <td>{{$val->date0021}}</td>
        <td>{{$val->datatxt0147}}</td>

        <td>{{$val->datatxt0148}}</td>
        <td>{{$val->datatxt0149}}</td>
        <td>{{$val->datatxt0150}}</td>
        <td>{{$val->datatxt0151}}</td>
        <td>{{$val->datatxt0152}}</td>
        <td>{{$val->datatxt0153}}</td>
        <td>{{$val->datatxt0154}}</td>
        <td>{{$val->datatxt0155}}</td>
        <td>{{$val->datatxt0156}}</td>
        <td>{{$val->datatxt0157}}</td>

        <td>{{$val->datatxt0158}}</td>
        <td>{{$val->datatxt0159}}</td>
        <td>{{$val->datatxt0160}}</td>
        <td>{{$val->datatxt0161}}</td>
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
