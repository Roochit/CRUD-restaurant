@extends('home')

@section('css_before')
@endsection

@section('header')
@endsection

@section('sidebarMenu')
@endsection

@section('content')
<h3>
    :: Member Managements ::
    <a href="/student/adding" class="btn btn-primary btn-sm"> Add Member </a>
</h3>

<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr class="table-info">
            <th width="5%" class="text-center">No.</th>
            <th width="5%">Pic</th>
            <th width="65%">Member Name & Detail</th>
            <th width="15%" class="text-center">Member ID</th>
            <th width="5%" class="text-center">Edit</th>
            <th width="5%" class="text-center">Delete</th>
        </tr>
    </thead>

    <tbody>
        @forelse($student as $row)
        <tr>
            <td align="center">
    {{ $student->firstItem() + $loop->index }}
</td>


            <td>
                @if($row->std_img)
                    <img src="{{ asset('storage/' . $row->std_img) }}" width="100">
                @else
                    <span class="text-muted">No Image</span>
                @endif
            </td>

            <td>
                <b>Name: {{ $row->std_name }}</b> <br>
                Phone: {{ $row->std_phone }}
            </td>

            <td align="center">
                {{ $row->std_code }}
            </td>

            <td align="center">
                <a href="/student/{{ $row->id }}" class="btn btn-warning btn-sm">edit</a>
            </td>

            <td align="center">
                <button type="button"
                        class="btn btn-danger btn-sm"
                        onclick="deleteConfirm({{ $row->id }})">
                    delete
                </button>

                <form id="delete-form-{{ $row->id }}"
                      action="/student/remove/{{ $row->id }}"
                      method="POST"
                      style="display:none;">
                    @csrf
                    @method('delete')
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center text-muted">
                ไม่พบข้อมูลนักศึกษา
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

<div>
    {{ $student->links() }}
</div>
@endsection

@section('footer')
@endsection

@section('js_before')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function deleteConfirm(id) {
    Swal.fire({
        title: 'แน่ใจหรือไม่?',
        text: "คุณต้องการลบข้อมูลนี้จริง ๆ หรือไม่",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ใช่, ลบเลย!',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>
@endsection
