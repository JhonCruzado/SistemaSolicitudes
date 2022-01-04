<div>
    <div class="modal fade text-start fade show" id="inlineForm" style="display: block;" tabindex="-1"
        aria-labelledby="myModalLabel33" aria-hidden="true" role="dialog">
        <div {{$attributes->merge(['class' => 'modal-dialog modal-dialog-centered']) }}>
            <div class="modal-content">
                {{ $slot }}
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
</div>
