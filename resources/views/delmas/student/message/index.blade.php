@extends('delmas.student.components.layout')

@section('content')
    <script src="https://cdn.tiny.cloud/1/tnjcopg6t6wv6gt3ukksyo0w89pa2qwmlscl1ripsfllhhjo/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#basic-example', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
        });
    </script>

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Messages
    </h2>
    <form action="" method="POST">
    @csrf
    <label class="block mt-4 text-sm mb-4">
        <span class="text-gray-700 dark:text-gray-400">
          Envoyé à :
        </span>
        <select name="prof" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
            <option>Mme. Delmas</option>
            <option>Mr. Henri</option>
        </select>
    </label>

        <textarea name="message" id="basic-example"></textarea>

    <div class="w-full flex justify-end mt-4">
        <button type="submit" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            <span>Envoyer</span>
            <svg
                class="ml-2 w-5 h-5"
                fill="currentColor"
                viewBox="0 0 24 24"
            >
                <path d="m21.426 11.095-17-8A.999.999 0 0 0 3.03 4.242L4.969 12 3.03 19.758a.998.998 0 0 0 1.396 1.147l17-8a1 1 0 0 0 0-1.81zM5.481 18.197l.839-3.357L12 12 6.32 9.16l-.839-3.357L18.651 12l-13.17 6.197z"></path></svg>
        </button>
    </div>
    </form>

@endsection
