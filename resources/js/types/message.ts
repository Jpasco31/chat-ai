export interface Context {
    content: string;
    role: string;
}

export interface Chat {
    id: number;
    context: Context[];
}

export interface Message {
    id: number;
    user_id: number;
    context: Context[];
}
