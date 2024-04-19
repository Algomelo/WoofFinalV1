<table>
    <thead>
        <tr>
            <th>Email</th>
            <th>Comment</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Age</th>
            <th>DogName</th>
            <th>Breed</th>
            <th>Address</th>
            <th>Service</th>
            <th>Form</th>
            <th>Create at</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sistemsemails as $sistemsemail)
            <tr>>
                <td> {{$sistemsemail->email}} </td>
                <td> {{$sistemsemail->comment}} </td>
                <td> {{$sistemsemail->name}} </td>
                <td> {{$sistemsemail->phone}} </td>
                <td> {{$sistemsemail->age}} </td>
                <td> {{$sistemsemail->dogname}} </td>
                <td> {{$sistemsemail->breed}} </td>
                <td> {{$sistemsemail->address}} </td>
                <td> {{$sistemsemail->service}} </td>
                <td> {{$sistemsemail->from}} </td>
                <td> {{$sistemsemail->create_at}} </td>
            </tr>            
        @endforeach
    </tbody>
</table>


