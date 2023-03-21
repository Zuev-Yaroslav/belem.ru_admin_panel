@if(isset($images))
    @foreach($images as $img)
    @php
        if ($img->file_size < 1048576 && $img->file_size >= 1024) {
            $img->file_size = round($img->file_size/1024, 3);
            $img->file_size = $img->file_size . 'Кб';
        } elseif ($img->file_size >= 1048576) {
            $img->file_size = round($img->file_size/1024/1024, 3);
            $img->file_size = $img->file_size . 'Мб';
        }
    @endphp
    <button class="border-0 m-3 p-0 rounded gallery-img-div show-modal position-relative" data-id="#image{{ $img->id }}">
        <img loading="lazy" class="rounded object-fit-cover" width="100%" height="100%" src="{{ asset('storage/' . $img->image_link) }}" alt="{{ $img->alt }}">
        <div class="pl-4 form-check position-absolute top-0 start-100 translate-middle d-none">
            <input form="DeleteSelected" class="form-check-input select-img" type="checkbox" value="{{ $img->id }}" name="selected[]">
        </div>
    </button>
    <div class="modal fade" id="image{{ $img->id }}">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Информация о содержимом</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body row p-0">
                        <div class="w-50">
                            <img width="100%" height="auto" src="{{ asset('storage/' . $img->image_link) }}" alt="{{ $img->alt }}">
                        </div>
                        <div class="w-50 pr-2">
                            <div class="bg-secondary-subtle border border-top-0 border-bottom-0 p-3 h-100">
                                <p class="mb-1"><b>Имя файла: </b>{{ $img->file_name }}</p>
                                <p class="mb-1"><b>Тип файла: </b>{{ $img->file_type }}</p>
                                <p class="mb-1"><b>Размер файла: </b>{{ $img->file_size }}</p>
                                <form id="EditImage{{ $img->id }}" class="EditImage" method="post" action="{{ route('admin.gallery.update', $img->id) }}">
                                @method('patch')
                                @csrf
                                    <div class="mb-3">
                                        <label for="alt{{ $img->id }}" class="form-label">Атрибут alt</label>
                                        <input type="text" name="alt" class="form-control" id="alt{{ $img->id }}" value="{{ $img->alt }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="title{{ $img->id }}" class="form-label">Заголовок</label>
                                        <input type="text" name="title" class="form-control" id="title{{ $img->id }}" value="{{ $img->title }}">
                                    </div>
                                </form>
                                <form action="{{ route('admin.gallery.destroy', $img->id) }}" data-id="{{ $img->id }}" class="DeleteImage" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-outline-danger">Удалить навсегда</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button form="EditImage{{ $img->id }}" type="submit" class="btn btn-primary">Изменить изменения</button>
                    </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @endforeach
@endif
