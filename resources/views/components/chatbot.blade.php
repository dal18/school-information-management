<!-- AI Chatbot Widget -->
<div x-data="{
    open: false,
    minimized: false,
    messages: [
        {
            type: 'bot',
            text: 'Hi! 👋 I\'m the LFHS Virtual Assistant. How can I help you today?',
            time: new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})
        }
    ],
    inputMessage: '',
    quickReplies: [
        { icon: 'fa-graduation-cap', text: 'Admissions Process', response: 'Our admissions process is simple! Submit an online application, provide required documents (birth certificate, report cards, ID), and we\'ll review within 2-3 weeks. Would you like to start an application?' },
        { icon: 'fa-money-bill-wave', text: 'Tuition Fees', response: 'Tuition fees vary by grade level. We offer flexible payment plans and scholarship opportunities. For detailed fee structure, please contact our admissions office at (123) 456-7890 or visit us in person.' },
        { icon: 'fa-calendar', text: 'School Calendar', response: 'Our academic calendar runs from June to March. We have regular holidays, semester breaks, and school events throughout the year. Would you like me to show you the full calendar?' },
        { icon: 'fa-building', text: 'Facilities Tour', response: 'We\'d love to show you our campus! We offer both virtual tours and in-person visits. Our facilities include smart classrooms, science labs, library, sports complex, and more. Schedule a visit?' }
    ],

    sendMessage(messageText = null) {
        const text = messageText || this.inputMessage.trim();
        if (!text) return;

        // Add user message
        this.messages.push({
            type: 'user',
            text: text,
            time: new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})
        });

        this.inputMessage = '';

        // Simulate bot typing
        setTimeout(() => {
            const response = this.getBotResponse(text);
            this.messages.push({
                type: 'bot',
                text: response,
                time: new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})
            });
            this.$nextTick(() => {
                const chatBody = this.$refs.chatBody;
                if (chatBody) {
                    chatBody.scrollTop = chatBody.scrollHeight;
                }
            });
        }, 1000);
    },

    sendQuickReply(reply) {
        this.messages.push({
            type: 'user',
            text: reply.text,
            time: new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})
        });

        setTimeout(() => {
            this.messages.push({
                type: 'bot',
                text: reply.response,
                time: new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})
            });
            this.$nextTick(() => {
                const chatBody = this.$refs.chatBody;
                if (chatBody) {
                    chatBody.scrollTop = chatBody.scrollHeight;
                }
            });
        }, 800);
    },

    getBotResponse(message) {
        const msg = message.toLowerCase();

        if (msg.includes('admission') || msg.includes('enroll') || msg.includes('apply')) {
            return 'Great! I can help you with admissions. You can apply online through our admissions page. The process takes about 10 minutes. Required documents: birth certificate, report cards, and ID. Shall I direct you to the application form?';
        }
        else if (msg.includes('fee') || msg.includes('tuition') || msg.includes('cost') || msg.includes('price')) {
            return 'Tuition fees depend on the grade level. We also offer payment plans and scholarships. For exact pricing, please contact our office at (123) 456-7890 or email info@lfhs.edu. Would you like me to connect you with our admissions team?';
        }
        else if (msg.includes('schedule') || msg.includes('class') || msg.includes('time')) {
            return 'Class schedules vary by grade level and section. You can view all schedules on our Schedules page. Would you like to see the current schedules or learn about specific programs?';
        }
        else if (msg.includes('contact') || msg.includes('phone') || msg.includes('email')) {
            return 'You can reach us at:\n📞 Phone: (123) 456-7890\n📧 Email: info@lfhs.edu\n📍 Address: 123 Main Street, City, Province\n⏰ Hours: Mon-Fri, 7:00 AM - 5:00 PM';
        }
        else if (msg.includes('facility') || msg.includes('campus') || msg.includes('tour')) {
            return 'Our campus features state-of-the-art facilities including smart classrooms, science labs, library, sports complex, and more! We offer virtual tours and in-person visits. Would you like to schedule a campus tour?';
        }
        else {
            return 'Thanks for your question! For detailed information, please contact our office at (123) 456-7890 or email info@lfhs.edu. Is there anything specific about admissions, fees, or our programs I can help with?';
        }
    }
}"
@keydown.escape.window="open = false"
class="fixed bottom-6 left-6 z-50"
x-cloak>

    <!-- Chat Button (when closed) -->
    <button
        x-show="!open"
        @click="open = true"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-75"
        x-transition:enter-end="opacity-100 scale-100"
        class="group relative w-16 h-16 bg-gradient-to-br from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 rounded-full shadow-2xl flex items-center justify-center transition-all duration-300 transform hover:scale-110"
        style="display: none;">

        <!-- Pulse Animation -->
        <span class="absolute inset-0 rounded-full bg-primary-600 animate-ping opacity-75"></span>

        <!-- Icon -->
        <i class="fas fa-comments text-2xl text-white relative z-10"></i>

        <!-- Notification Badge -->
        <span class="absolute -top-1 -right-1 w-6 h-6 bg-accent-500 text-white text-xs font-bold rounded-full flex items-center justify-center border-2 border-white">
            1
        </span>
    </button>

    <!-- Chat Window -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-4"
        :class="minimized ? 'h-16' : 'h-[600px]'"
        class="w-96 bg-white rounded-2xl shadow-2xl flex flex-col overflow-hidden transition-all duration-300"
        style="display: none;">

        <!-- Header -->
        <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white p-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-robot text-xl"></i>
                </div>
                <div>
                    <h3 class="font-bold">LFHS Assistant</h3>
                    <p class="text-xs opacity-90">
                        <span class="inline-block w-2 h-2 bg-accent-400 rounded-full mr-1"></span>
                        Online
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <button @click="minimized = !minimized" class="w-8 h-8 hover:bg-white/20 rounded-lg flex items-center justify-center transition-colors">
                    <i class="fas" :class="minimized ? 'fa-window-maximize' : 'fa-window-minimize'"></i>
                </button>
                <button @click="open = false" class="w-8 h-8 hover:bg-white/20 rounded-lg flex items-center justify-center transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <!-- Chat Body -->
        <div x-show="!minimized" class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50" x-ref="chatBody">
            <template x-for="(message, index) in messages" :key="index">
                <div :class="message.type === 'user' ? 'flex justify-end' : 'flex justify-start'">
                    <div :class="message.type === 'user'
                        ? 'bg-primary-600 text-white rounded-2xl rounded-tr-sm'
                        : 'bg-white text-gray-800 rounded-2xl rounded-tl-sm shadow-sm'"
                        class="max-w-[80%] px-4 py-3">
                        <p class="text-sm leading-relaxed" x-text="message.text"></p>
                        <p class="text-xs mt-1 opacity-70" x-text="message.time"></p>
                    </div>
                </div>
            </template>

            <!-- Quick Replies -->
            <div x-show="messages.length === 1" class="space-y-2">
                <p class="text-xs text-gray-500 text-center">Quick actions:</p>
                <template x-for="reply in quickReplies" :key="reply.text">
                    <button
                        @click="sendQuickReply(reply)"
                        class="w-full bg-white hover:bg-primary-50 border border-gray-200 hover:border-primary-300 rounded-lg p-3 text-left transition-all duration-200 flex items-center gap-3 group">
                        <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center group-hover:bg-primary-200 transition-colors">
                            <i :class="'fas ' + reply.icon" class="text-primary-600"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-700 group-hover:text-primary-700" x-text="reply.text"></span>
                    </button>
                </template>
            </div>
        </div>

        <!-- Input Area -->
        <div x-show="!minimized" class="p-4 bg-white border-t border-gray-200">
            <form @submit.prevent="sendMessage()" class="flex gap-2">
                <input
                    x-model="inputMessage"
                    type="text"
                    placeholder="Type your message..."
                    class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm"
                    @keydown.enter.prevent="sendMessage()">
                <button
                    type="submit"
                    class="px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-xl transition-colors duration-200 flex items-center justify-center">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </form>
            <p class="text-xs text-gray-500 mt-2 text-center">
                Powered by LFHS Virtual Assistant
            </p>
        </div>
    </div>
</div>
