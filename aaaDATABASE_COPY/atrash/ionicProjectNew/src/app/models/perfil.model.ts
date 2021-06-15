export class Perfil {
    private _id: number;
    private _usuari: string;
    private _nom: string;
    private _cognom: string;
    private _correu: string;
    private _telefon: string;

    constructor() {
    }

    get id(): number {
        return this._id;
    }
    get usuari(): string {
        return this._usuari;
    }
    get nom(): string {
        return this._nom;
    }
    get cognom(): string {
        return this._cognom;
    }
    get correu(): string {
        return this._correu;
    }
    get telefon(): string {
        return this._telefon;
    }


    set id(id: number) {
        this._id = id;
    }
    set usuari(usuari: string) {
        this._usuari = usuari;
    }
    set nom(nom: string) {
        this._nom = nom;
    }
    set cognom(cognom: string) {
        this._cognom = cognom;
    }
    set correu(correu: string) {
        this._correu = correu;
    }
    set telefon(telefon: string) {
        this._telefon = telefon;
    }
}
