<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
</head>
<body>
@php
    //dd($data);
@endphp
<table id="customers">
    <tr>
        <td>
            <h2>Easy School ERP</h2><br>
            <p>Shcool: Address</p>
            <p>Phone: 0951111111</p>
            <p>Email: easy_school@gmail.com</p>
        </td>
        <td><img src="{{ public_path($data[0]->student_user->image) }}"/></td>
    </tr>
</table>


<table id="customers">
  <tr>
    <th style="width:10%;">SL</th>
    <th style="width:45%;">Student Detials</th>
    <th style="width:45%;">Student Data</th>
  </tr>
  <tr>
    <td>1</td>
    <td>Student Name</td>
    <td>{{ $data[0]->student_user->name }}</td>
  </tr>
  <tr>
    <td>1</td>
    <td>Student ID No</td>
    <td>{{ $data[0]->student_user->id_no }}</td>
  </tr>
  <tr>
    <td>2</td>
    <td>Father's Name</td>
    <td>{{ $data[0]->student_user->fname }}</td>
  </tr>
  <tr>
    <td>3</td>
    <td>Mother's Name</td>
    <td>{{ $data[0]->student_user->mname }}</td>
  </tr>
  <tr>
    <td>4</td>
    <td>Mobile</td>
    <td>{{ $data[0]->student_user->mobile }}</td>
  </tr>
  <tr>
    <td>5</td>
    <td>Address</td>
    <td>{{ $data[0]->student_user->address }}</td>
  </tr>
  <tr>
    <td>6</td>
    <td>Gender</td>
    <td>{{ $data[0]->student_user->gender }}</td>
  </tr>
  <tr>
    <td>7</td>
    <td>Religion</td>
    <td>{{ $data[0]->student_user->religion }}</td>
  </tr>
  <tr>
    <td>8</td>
    <td>Date of Birth</td>
    <td>{{ $data[0]->student_user->dob }}</td>
  </tr>
  <tr>
    <td>9</td>
    <td>Discount</td>
    <td>{{ $data[0]->student_discount->discount }}</td>
  </tr>
  <tr>
    <td>10</td>
    <td>Year</td>
    <td>{{ $data[0]->student_year->name }}</td>
  </tr>
  <tr>
    <td>11</td>
    <td>Class</td>
    <td>{{ $data[0]->student_class->name }}</td>
  </tr>
  <tr>
    <td>12</td>
    <td>Group</td>
    <td>{{ $data[0]->student_group->name }}</td>
  </tr>
  <tr>
    <td>13</td>
    <td>Shift</td>
    <td>{{ $data[0]->student_shift->name }}</td>
  </tr>


</table>
<br>
<i style="font-size:15px;float:right;">Print Date : {{ date('Y-m-d') }}</i>


</body>
</html>
