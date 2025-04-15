@extends('admin.Layouts.AuthenticatedLayout')

@section('title', 'Admin Panel')

@section('content')
    {{-- Header + déconnexion --}}
    <div class="bg-[#0D0D0D] p-6 rounded-lg shadow-md flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-semibold text-white">Bienvenue, Admin</h2>
            <p class="mt-2 text-gray-400">Gérez votre boutique ici.</p>
        </div>
    </div>

    {{-- Grille de graphiques --}}
    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- CA mensuel --}}
        <div class="bg-[#0D0D0D] p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4 text-white">CA mensuel {{ now()->year }}</h3>
            <canvas id="salesChart"  height="150" class="h-32 w-full"></canvas>
        </div>

        {{-- Ventes par produit --}}
        <div class="bg-[#0D0D0D] p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4 text-white">Quantités vendues par produit</h3>
            <canvas id="productSalesChart"  height="150" class="h-32 w-full"></canvas>
        </div>

        {{-- Statut commandes --}}
        {{-- <div class="bg-[#0D0D0D] p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4 text-white">Répartition statuts commandes</h3>
            <canvas id="orderStatusChart"  height="150" class="h-32 w-full"></canvas>
        </div> --}}

        {{-- Statut factures --}}
        {{-- <div class="bg-[#0D0D0D] p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4 text-white">Répartition statuts factures</h3>
            <canvas id="invoiceStatusChart"  height="150" class="h-32 w-full"></canvas>
        </div> --}}

        {{-- Statut paiements --}}
        {{-- <div class="bg-[#0D0D0D] p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4 text-white">Répartition statuts paiements</h3>
            <canvas id="paymentStatusChart"  height="150" class="h-32 w-full"></canvas>
        </div> --}}
    </div>

    {{-- Liste des commandes --}}
    <div class="mt-8 bg-[#0D0D0D] p-6 rounded-lg shadow-md overflow-x-auto">
        <h3 class="text-xl font-semibold mb-4 text-white">Liste des commandes</h3>
        <table class="min-w-full table-auto text-white">
            <thead class="bg-gray-900">
                <tr>
                    <th class="px-4 py-2">Réf</th>
                    <th class="px-4 py-2">Produit</th>
                    <th class="px-4 py-2">Quantité</th>
                    <th class="px-4 py-2">Prix (€)</th>
                    <th class="px-4 py-2">Statut Cmd</th>
                    <th class="px-4 py-2">Statut Facture</th>
                    <th class="px-4 py-2">Statut Paiement</th>
                </tr>
            </thead>
            <tbody>
                @forelse($detailed as $order)
                    @foreach($order['lines'] as $line)
                        <tr class="border-b border-gray-700">
                            <td class="px-4 py-2">{{ $order['ref'] }}</td>
                            <td class="px-4 py-2">{{ $line['product_name'] }}</td>
                            <td class="px-4 py-2">{{ $line['quantity'] }}</td>
                            <td class="px-4 py-2">{{ number_format($line['price'], 2, ',', ' ') }}</td>
                            <td class="px-4 py-2">{{ $order['order_status'] }}</td>
                            <td class="px-4 py-2">{{ $order['invoice_status'] }}</td>
                            <td class="px-4 py-2">{{ $order['payment_status'] }}</td>
                        </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-2 text-center text-gray-500">
                            Aucune commande trouvée.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // CA mensuel
        new Chart(document.getElementById('salesChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: @json($labels),
                datasets: [{ label: "CA mensuel (€)", backgroundColor: '#4f46e5', data: @json($data) }]
            },
            options: { responsive:true, scales:{ y:{ beginAtZero:true } } }
        });

        // Ventes par produit
        new Chart(document.getElementById('productSalesChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: @json($productLabels),
                datasets: [{ label: "Quantité vendue", backgroundColor: '#10B981', data: @json($productData) }]
            },
            options: { responsive:true, scales:{ y:{ beginAtZero:true } } }
        });

        // Pie : statuts commandes
        new Chart(document.getElementById('orderStatusChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: @json($orderStatusLabels),
                datasets: [{ data: @json($orderStatusData), backgroundColor: ['#3B82F6','#F59E0B'] }]
            },
            options: { responsive:true }
        });

        // Pie : statuts factures
        new Chart(document.getElementById('invoiceStatusChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: @json($invoiceStatusLabels),
                datasets: [{ data: @json($invoiceStatusData), backgroundColor: ['#8B5CF6','#6B7280'] }]
            },
            options: { responsive:true }
        });

        // Pie : statuts paiements
        new Chart(document.getElementById('paymentStatusChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: @json($paymentStatusLabels),
                datasets: [{ data: @json($paymentStatusData), backgroundColor: ['#10B981','#EF4444'] }]
            },
            options: { responsive:true }
        });
    </script>
@endsection
