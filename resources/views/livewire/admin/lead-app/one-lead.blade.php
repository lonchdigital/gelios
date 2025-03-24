<tr>
    <td class="whitespace-nowrap">{{ $feedback->type }}</td>
    <td class="whitespace-nowrap">{{ $feedback->name }}</td>
    <td>{{ $feedback->phone }}</td>
    <td>
        {!! ($feedback->doctor_specialist . '<br>') ?? '' !!}
        {{ $feedback->clinic_name ?? ''}}
    </td>
    <td>
        <select wire:model.live="status" class="select {{ $feedback->statusClass }}" style="cursor: pointer; border: 0px;">
            @foreach ($statuses as $status2)
                <option value="{{ $status2 }}" @if ($this->status === $status2) selected @endif>
                    {{ __('status.' . $status2) }}
                </option>
            @endforeach
        </select>
    </td>
</tr>
