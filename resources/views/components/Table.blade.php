<?php
$data = [['id' => 1, 'name' => 'John Doe', 'email' => '@gmail.com']];
?>
<table style="border-spacing: 0px">
    @foreach ($data as $row)
        <tr>
            <td style="border: 1px solid black; width: 100px; height: 20px; text-align: center;">
                {{ $row['id'] }}
            </td>
            <td style="border: 1px solid black; width: 100px; height: 20px; text-align: center;">
                {{ $row['name'] }}
            </td>
            <td style="border: 1px solid black; width: 100px; height: 20px; text-align: center;">
                {{ $row['email'] }}
            </td>
        </tr>
    @endforeach
</table>
