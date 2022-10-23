
<!-- Modal -->

<div class="modal fade" id="modalDelete{{$id, $name}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDelete">Deleted by id</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <form action="{{route($name.'.destroy', $id)}}" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    Are You sure you want to delete <b>ID</b> with <b>{{$id}}</b>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn col-auto bg-dark text-white">Delete</button>

                </div>
            </form>
        </div>
    </div>
</div>
