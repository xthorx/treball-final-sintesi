export class Recurs {
    private _id: number;
    private _titol: string;
    private _autor: string;
    private _privadesa: string;
    private _categoria: string;

    constructor() {
    }

    get id(): number {
        return this._id;
    }
    get titol(): string {
        return this._titol;
    }
    get autor(): string {
        return this._autor;
    }
    get privadesa(): string {
        return this._privadesa;
    }
    get categoria(): string {
        return this._categoria;
    }


    set id(id: number) {
        this._id = id;
    }
    set titol(titol: string) {
        this._titol = titol;
    }
    set autor(autor: string) {
        this._autor = autor;
    }
    set privadesa(privadesa: string) {
        this._privadesa = privadesa;
    }
    set categoria(categoria: string) {
        this._categoria = categoria;
    }
}
