<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-3 py-1 rounded-full border border-emerald-100 uppercase tracking-widest">
                System Status: Online
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="bg-white shadow-sm border border-gray-100 rounded-3xl p-8">
                <div class="max-w-2xl">
                    <h1 class="text-2xl font-bold text-gray-900 capitalize">
                        Welcome, {{ Auth::user()->name }}!
                    </h1>
                    <p class="mt-2 text-gray-600 leading-relaxed">
                        @if(Auth::user()->role === 'teacher')
                            Manage your classroom, upload teaching resources, and enter student marks.
                        @elseif(Auth::user()->role === 'headteacher')
                            Verify school-wide data, monitor teacher activity, and generate report cards.
                        @elseif(Auth::user()->role === 'cluster_head')
                            Oversee performance across multiple schools in your cluster.
                        @elseif(Auth::user()->role === 'ministry')
                            Access national-level analytics and policy implementation data.
                        @endif
                    </p>
                </div>
            </div>

            <div>
                <h3 class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-4 ml-2">Available Modules</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    @if(Auth::user()->role === 'teacher')
                        <x-action-card title="Resource Hub" desc="Upload lesson notes and syllabus." icon="book" link="#" />
                        <x-action-card title="Term Marks" desc="Enter and sync student marks." icon="grade" :link="route('gradebook')" />
                        <x-action-card title="Innovation" desc="Submit ideas to the Ministry." icon="lightbulb" link="#" />
                    
                    @elseif(Auth::user()->role === 'headteacher')
                        <x-action-card title="Grade Approval" desc="Review and lock teacher-submitted marks." icon="check" link="#" />
                        <x-action-card title="School Reports" desc="Generate and print digital report cards." icon="report" link="#" />
                        <x-action-card title="User Management" desc="Manage teacher accounts and roles." icon="users" link="#" />
                        <x-action-card 
    title="School Reports" 
    desc="Generate and print digital report cards." 
    icon="report" 
    :link="route('reports')" 
/>

                    @elseif(Auth::user()->role === 'cluster_head')
                        <x-action-card title="Cluster Overview" desc="Compare performance across cluster schools." icon="chart" link="#" />
                        <x-action-card title="Inspection" desc="Log and view school inspection reports." icon="search" link="#" />
                        <x-action-card title="Resource Allocation" desc="Manage cluster-wide book/tool distribution." icon="truck" link="#" />

                    @elseif(Auth::user()->role === 'ministry')
                        <x-action-card title="National Analytics" desc="Big data view of national performance." icon="globe" link="#" />
                        <x-action-card title="Policy Control" desc="Update syllabus and national requirements." icon="briefcase" link="#" />
                        <x-action-card title="Funding" desc="Monitor school grants and financial data." icon="money" link="#" />
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>