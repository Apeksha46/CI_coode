<tr class="expandable-body">
    <td>
        <div class="p-0">
            <table class="table table-hover">
                <tbody>
                    @foreach($childs as $child)
                    <tr data-widget="expandable-table" aria-expanded="false">

                        <td>
                            @if(count($child->childs)) <i
                                class="expandable-table-caret fas fa-caret-right fa-fw"></i>@endif
                            {{ $child->name }}

                            @if($child->status == 0)
                            <button title="Status " class="btn ipfs-button" value="{{ $child }})"
                                onclick="change_status('{{ $child->id }}','Deactive','1')"> Active
                            </button>
                            @else
                            <button title="Status " class="btn ipfs-danger" value="{{ $child }})"
                                onclick="change_status('{{ $child->id }}','Active','0')"> Deactive
                            </button>
                            @endif

                            <form action="{{ route('categories_trees.destroy', $child) }}" method="POST">
                                <button type="button" class="btn ipfs-button edit-category" data-id="{{ $child->id }}"
                                    data-name="{{ $child->name }}" data-parent_id="{{ $child->parent_id }}">
                                    <i class="fa fa-pencil"></i>
                                </button>

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn ipfs-button" title="Delete Category"
                                    onclick="return confirm('Are you sure want to delete this category!')"><i
                                        class="fa fa-trash"></i></button>
                            </form>

                        </td>

                    </tr>

                    @if(count($child->childs))
                        @include('admin/categories_trees/manageChild',['childs' => $child->childs])
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </td>
</tr>