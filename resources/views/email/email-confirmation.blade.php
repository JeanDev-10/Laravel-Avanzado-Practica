<x-mail::message>
# Hola {{$name}}
<x-mail::panel>
Por favor confirma tu correo electronico con el siguiente enlace
</x-mail::panel>
<x-mail::button :url="$url">
Click aquí
</x-mail::button>
</x-mail::message>
