@extends('layouts.admin')

@section('content')
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Deep Analytics Dashboard</h2>
        <p class="text-gray-400 text-sm">Visualizing platform performance and user engagement</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-br from-indigo-900/50 to-[#1a222d] border border-indigo-500/30 p-6 rounded-xl shadow-lg relative overflow-hidden">
            <div class="absolute right-0 top-0 opacity-10 p-4"><i class="fa-solid fa-chart-line text-8xl"></i></div>
            <h3 class="text-gray-400 font-medium mb-1">Monthly Growth</h3>
            <div class="text-3xl font-bold text-white mb-2">+24.5%</div>
            <div class="text-xs text-green-400"><i class="fa-solid fa-arrow-trend-up mr-1"></i> Compared to last month</div>
        </div>
        
        <div class="bg-gradient-to-br from-blue-900/50 to-[#1a222d] border border-blue-500/30 p-6 rounded-xl shadow-lg relative overflow-hidden">
            <div class="absolute right-0 top-0 opacity-10 p-4"><i class="fa-solid fa-users text-8xl"></i></div>
            <h3 class="text-gray-400 font-medium mb-1">Conversion Rate</h3>
            <div class="text-3xl font-bold text-white mb-2">12.8%</div>
            <div class="text-xs text-blue-400"><i class="fa-solid fa-bolt mr-1"></i> Visitors to Active Users</div>
        </div>

        <div class="bg-gradient-to-br from-purple-900/50 to-[#1a222d] border border-purple-500/30 p-6 rounded-xl shadow-lg relative overflow-hidden">
            <div class="absolute right-0 top-0 opacity-10 p-4"><i class="fa-solid fa-graduation-cap text-8xl"></i></div>
            <h3 class="text-gray-400 font-medium mb-1">Course Completion</h3>
            <div class="text-3xl font-bold text-white mb-2">68.2%</div>
            <div class="text-xs text-purple-400"><i class="fa-solid fa-check-double mr-1"></i> Global completion rate</div>
        </div>

        <div class="bg-gradient-to-br from-green-900/50 to-[#1a222d] border border-green-500/30 p-6 rounded-xl shadow-lg relative overflow-hidden">
            <div class="absolute right-0 top-0 opacity-10 p-4"><i class="fa-solid fa-wallet text-8xl"></i></div>
            <h3 class="text-gray-400 font-medium mb-1">Avg. Commission</h3>
            <div class="text-3xl font-bold text-white mb-2">$42.50</div>
            <div class="text-xs text-green-400"><i class="fa-solid fa-money-bill-wave mr-1"></i> Per active user</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-[#1a222d] border border-[#334155] p-6 rounded-xl shadow-lg relative">
            <h3 class="text-gray-200 font-bold mb-6 flex items-center"><i class="fa-solid fa-chart-area text-indigo-500 mr-2"></i> Revenue & Registration Trends (Mockup)</h3>
            <div class="h-64 flex items-end justify-between gap-2 px-4 pb-4 border-b border-l border-[#334155] relative">
                <!-- Mockup Bar Chart -->
                <div class="w-1/12 bg-indigo-500 hover:bg-indigo-400 transition-all rounded-t" style="height: 30%"></div>
                <div class="w-1/12 bg-indigo-500 hover:bg-indigo-400 transition-all rounded-t" style="height: 50%"></div>
                <div class="w-1/12 bg-indigo-500 hover:bg-indigo-400 transition-all rounded-t" style="height: 40%"></div>
                <div class="w-1/12 bg-indigo-500 hover:bg-indigo-400 transition-all rounded-t" style="height: 70%"></div>
                <div class="w-1/12 bg-indigo-500 hover:bg-indigo-400 transition-all rounded-t" style="height: 60%"></div>
                <div class="w-1/12 bg-indigo-500 hover:bg-indigo-400 transition-all rounded-t" style="height: 90%"></div>
                <div class="w-1/12 bg-indigo-500 hover:bg-indigo-400 transition-all rounded-t" style="height: 85%"></div>
            </div>
            <div class="flex justify-between text-xs text-gray-500 mt-2 px-4">
                <span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span><span>Sun</span>
            </div>
        </div>

        <div class="bg-[#1a222d] border border-[#334155] p-6 rounded-xl shadow-lg">
            <h3 class="text-gray-200 font-bold mb-6 flex items-center"><i class="fa-solid fa-chart-pie text-orange-500 mr-2"></i> User Distribution by Package (Mockup)</h3>
            <div class="h-64 flex items-center justify-center relative">
                <!-- Mockup Pie Chart using CSS Conic Gradient -->
                <div class="w-48 h-48 rounded-full border-4 border-[#1a222d] shadow-2xl" 
                     style="background: conic-gradient(
                         #6366f1 0% 40%, 
                         #f97316 40% 70%, 
                         #10b981 70% 90%, 
                         #8b5cf6 90% 100%
                     );">
                </div>
            </div>
            <div class="flex flex-wrap justify-center gap-4 mt-4 text-xs text-gray-400">
                <span class="flex items-center"><span class="w-3 h-3 bg-[#6366f1] rounded-full mr-1"></span> Basic (40%)</span>
                <span class="flex items-center"><span class="w-3 h-3 bg-[#f97316] rounded-full mr-1"></span> Pro (30%)</span>
                <span class="flex items-center"><span class="w-3 h-3 bg-[#10b981] rounded-full mr-1"></span> Elite (20%)</span>
                <span class="flex items-center"><span class="w-3 h-3 bg-[#8b5cf6] rounded-full mr-1"></span> VIP (10%)</span>
            </div>
        </div>
    </div>
</div>
@endsection