<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <h2 class="text-xl font-bold mb-4">Manajemen Pengguna</h2>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b bg-slate-50">
                            <th class="p-3 text-sm font-semibold">Nama</th>
                            <th class="p-3 text-sm font-semibold">Email</th>
                            <th class="p-3 text-sm font-semibold">Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\User::all() as $u)
                        <tr class="border-b hover:bg-slate-50 transition">
                            <td class="p-3 text-sm text-slate-700">{{ $u->name }}</td>
                            <td class="p-3 text-sm text-slate-700">{{ $u->email }}</td>
                            <td class="p-3 text-sm">
                                <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold">
                                    {{ strtoupper($u->role) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>