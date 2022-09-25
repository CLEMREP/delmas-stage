<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgb(99 102 241)"><path d="M2 7v1l11 4 9-4V7L11 4z"></path><path d="M4 11v4.267c0 1.621 4.001 3.893 9 3.734 4-.126 6.586-1.972 7-3.467.024-.089.037-.178.037-.268V11L13 14l-5-1.667v3.213l-1-.364V12l-3-1z"></path></svg> <h1>Delmas Alternance</h1>
@else
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgb(99 102 241)"><path d="M2 7v1l11 4 9-4V7L11 4z"></path><path d="M4 11v4.267c0 1.621 4.001 3.893 9 3.734 4-.126 6.586-1.972 7-3.467.024-.089.037-.178.037-.268V11L13 14l-5-1.667v3.213l-1-.364V12l-3-1z"></path></svg> <br>
    {{ $slot }}
@endif
</a>
</td>
</tr>
