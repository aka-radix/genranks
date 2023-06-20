<div x-data="{
    timer: {
        days: '{{ $days() }}',
        hours: '{{ $hours() }}',
        minutes: '{{ $minutes() }}',
        seconds: '{{ $seconds() }}',
        show: new Date({{ $expires->timestamp }} * 1000).getTime() - new Date().getTime() >= 0,
    },
    error: '{{ $hasError }}',
    startCounter: function() {
        let runningCounter = setInterval(() => {
            let countDownDate = new Date({{ $expires->timestamp }} * 1000).getTime();
            let timeDistance = countDownDate - new Date().getTime();

            if (timeDistance < 0) {
                clearInterval(runningCounter);
                this.show = false
                return;
            }

            this.timer.days = this.formatCounter(Math.floor(timeDistance / (1000 * 60 * 60 * 24)));
            this.timer.hours = this.formatCounter(Math.floor((timeDistance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)));
            this.timer.minutes = this.formatCounter(Math.floor((timeDistance % (1000 * 60 * 60)) / (1000 * 60)));
            this.timer.seconds = this.formatCounter(Math.floor((timeDistance % (1000 * 60)) / 1000));
        }, 1000);
    },
    formatCounter: function(number) {
        return number.toString().padStart(2, '0');
    }
}" x-init="startCounter()" {{ $attributes }}>
    @if ($slot->isEmpty())
        <div x-show="false">
            Loading...
        </div>
        <div x-cloak x-show="error" class='relative'>
            Error!
        </div>
        <div x-cloak x-show="timer.show && !error">
            Updates in
            <span x-text="timer.hours">{{ $hours() }}</span>:<span
                x-text="timer.minutes">{{ $minutes() }}</span>:<span
                x-text="timer.seconds">{{ $seconds() }}</span>!
        </div>
        <div x-cloak x-show="!timer.show && !error" class='relative'>
            Processing
            <x-icon icon='loading' class='inline animate-spin' />
        </div>
    @else
        {{ $slot }}
    @endif
</div>
