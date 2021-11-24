<x-dashboard>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
                <div class="header">
                    <div class="header-body">
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Pretitle -->
                                <h6 class="header-pretitle">
                                    User
                                </h6>

                                <!-- Title -->
                                <h1 class="header-title">
                                    Invitations
                                </h1>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <invitations-list inline-template>
                        <div class="card-body">
                            <div class="list-group list-group-flush my-n3">

                                @forelse ($invitations as $invitation)
                                    <div class="list-group-item">
                                        <div class="row align-items-center">

                                            <div class="col ml-n2">
                                                <!-- Title -->
                                                <h4 class="mb-1">
                                                    <a href="#!">{{ $invitation->hotel->name }}</a>
                                                </h4>

                                                <!-- Email -->
                                                <p class="small text-muted mb-0">
                                                    <em>Invited By:</em> {{ $invitation->user->name }}
                                                </p>
                                            </div>
                                            <div class="col-auto">
                                                <!-- Dropdown -->
                                                <button class="btn btn-sm btn-primary"
                                                    @click="acceptInvitation('{{ $invitation->id }}')">Accept</button>
                                            </div>
                                        </div>
                                        <!-- / .row -->
                                    </div>
                                @empty
                                    <div class="text-center mt-5 mb-5">
                                        <h4 class="header-title">
                                            You don't have any pending invitaions
                                        </h4>
                                    </div>
                                @endforelse

                            </div>
                        </div>
                    </invitations-list>
                    <!-- / .card-body -->
                </div>
            </div>
        </div> <!-- / .row -->
    </div>
</x-dashboard>
