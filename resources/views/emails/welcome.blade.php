<x-mail::table>
| Laravel       | Table         | Example  |
| ------------- |:-------------:| --------:|
| Col 2 is      | Centered      | $10      |
| Col 3 is      | Right-Aligned | $20      |
</x-mail::table>

<x-mail::message>
# Planstadium

Welcome To Planstadium

<x-mail::button :url="'www.Planstadium.com'">
visit your account
</x-mail::button>

Thanks,<br>
{{ $nom }}
</x-mail::message>
