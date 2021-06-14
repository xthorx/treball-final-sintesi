export class Recurs {
    private _id: number;
    private _titol: string;
    private _descripcio: string;
    private _autor: string;
    private _privadesa: string;
    private _categoria: string;
    private _categoria_id: string;
    private _tipus: string;
    private _arxiu_name: string;

    constructor() {
    }

    get id(): number {
        return this._id;
    }
    get titol(): string {
        return this._titol;
    }
    get descripcio(): string {
        return this._descripcio;
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
    get categoria_id(): string {
        return this._categoria_id;
    }
    get tipus(): string {
        return this._tipus;
    }
    get arxiu_name(): string {
        return this._arxiu_name;
    }


    set id(id: number) {
        this._id = id;
    }
    set titol(titol: string) {
        this._titol = titol;
    }
    set descripcio(descripcio: string) {
        this._descripcio = descripcio;
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
    set categoria_id(categoria_id: string) {
        this._categoria_id = categoria_id;
    }
    set tipus(tipus: string) {
        this._tipus = tipus;
    }
    set arxiu_name(arxiu_name: string) {
        this._arxiu_name = arxiu_name;
    }
}
